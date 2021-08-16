<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerFormRequest;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    protected $model;
    protected $title;
    protected $subtitle;
    protected $view;
    protected $admin;
    protected $redirect;

    public function __construct(Person $model)
    {
        $this->model = $model;
        $this->title = 'Pessoas';
        $this->subtitle = 'Pessoa';
        $this->admin = 'admin.persons';
        $this->view = 'persons';
        $this->redirect = 'admin/persons';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->model->orderBy('id', 'desc')->paginate(10);

        $data = ['model' => $model, 'title' => $this->title, 'view' =>$this->view];

        return view($this->admin.'.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => $this->subtitle, 'view' => $this->view];

        return view($this->admin.'.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerFormRequest $request)
    {
        $dataForm = $request->all();
        if(isset($dataForm['image']))
        {
            $upload = upload_file($request, 'partners');
            $dataForm['image'] = $upload;
        }
        $model = $this->model->create($dataForm);

        if(!$model) return redirect($this->redirect)->with('fail', 'Houve um problema ao cadastrar o(a)!'.$this->subtitle);

        return redirect($this->redirect)->with('success', $this->subtitle.' cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model->findOrFail($id);

        $data = ['model' => $model, 'title' => $this->title, 'subtitle' => $this->subtitle, 'view' =>$this->view];

        return view($this->admin.'.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerFormRequest $request, $id)
    {
        $dataForm = $request->all();
        //dd($dataForm);
        $model = $this->model->findOrFail($id);
        if(valid_file($request)):
            $upload = upload_file($request, 'partners');
            if($upload):
                $dataForm['image'] = $upload;
                unset($dataForm['file']);
            endif;
        endif;
        $updated = $model->update($dataForm);

        if(!$updated) return redirect($this->redirect)->with('fail', 'Houve um problema ao editar o(a) '.$this->subtitle. '!');

        return redirect($this->redirect)->with('success', $this->subtitle.' editado(a) com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->model->destroy($id);

        if(!$deleted) return redirect($this->redirect)->with('fail', 'Houve um problema ao excluir a ' .$this->subtitle.'!');

        return redirect($this->redirect)->with('success', $this->subtitle.' excluída com sucesso!');
    }
    public function ativo($id)
    {
        $model = $this->model->findOrFail($id);
        if($model->published == 0){
            $model->published = 1;
            $model->save();
            return redirect($this->redirect)->with('success', $this->subtitle.' Ativado(a)');
        }else{
            $model->published = 0;
            $model->save();
            return redirect($this->redirect)->with('success', $this->subtitle.' Desativado(a)');
        }
    }

}
