<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PollsFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Poll;
use App\Models\Attribute;
use App\Models\AttributeValue;
// use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PollsController extends Controller
{
    protected $polls;
    protected $title;

    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
        $this->title = 'Enquetes';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polls = $this->poll->orderBy('id', 'desc')->paginate(10);

        $data = ['lista' => $polls, 'title' => $this->title];
        
        return view('admin.polls.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar Enquete' ];

        return view('admin.polls.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PollsFormRequest $request)
    {
        $dataForm = $request->only(['title', 'published_at', 'unpublished_at']);
        $dataForm['published_at'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['published_at']);
        $dataForm['unpublished_at'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['unpublished_at']);
        $alternatives = $request->only(['title_question']);

        $poll = $this->poll->create($dataForm);

        foreach(array_filter($alternatives['title_question']) as $key => $value) {
            $alternative = ['title' => $value, 'poll_id' => $poll->id];           
            Alternative::create($alternative);
        }       

        if(!$poll) return redirect('admin/polls')->with('fail', 'Houve um problema ao cadastrar a enquete!');

        try {
            \Cache::forget('poll');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect('admin/polls')->with('success', 'Enquete cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poll = Poll::where('id', $id)->with(['alternatives'])->first();

        $votos = Alternative::where('poll_id', $poll->id)->selectRaw('sum(votes) as total')->first();
        
        //dd($votos);

        $data = ['poll' => $poll, 'votos' => $votos, 'title' =>'Resultado da Enquete', 'subtitle' => 'Exibir enquete'];

        return view('admin.polls.show')->with($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poll = $this->poll->findOrFail($id);
        
        $alternatives = Alternative::where('poll_id', $id)->get();        

        $data = ['poll' => $poll, 'alternatives' => $alternatives, 'title' => $this->title, 'subtitle' => 'Editar enquete'];

        return view('admin.polls.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PollsFormRequest $request, $id)
    {
        $dataForm = $request->only(['title', 'published_at', 'unpublished_at']);
        $dataForm['published_at'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['published_at']);
        $dataForm['unpublished_at'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['unpublished_at']);

        $alternatives = $request->only(['title_question', 'id_question']);   

        $alternatives['title_question'] = array_filter($alternatives['title_question']);
        
        $alternatives['id_question'] = array_filter($alternatives['id_question']);        

        $poll = $this->poll->findOrFail($id);

        foreach($alternatives['title_question'] as $key => $value) {

            //dd($alternatives['id_question']);
            $alternative = ['title' => $value];           
            Alternative::where('id', $alternatives['id_question'][$key])->update($alternative);
        }             

        $updated = $poll->update($dataForm);

        if(!$updated) return redirect('admim/polls')->with('fail', 'Houve um problema ao editar a enquete!');

        try {
            \Cache::forget('poll');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect('admin/polls')->with('success', 'Enquete editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->poll->destroy($id);

        Alternative::where('poll_id', '=', $id)->delete();

        if(!$deleted) return redirect('admin/polls')->with('fail', 'Houve um problema ao excluir a Enquete!');

        return redirect('admin/polls')->with('success', 'Enquete excluída com sucesso!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request, $id)
    {
        $polls = $this->poll->find($id);
        $polls->status = !$polls->status;
        $polls->save();

        return redirect('/admin/polls');
    }


}
