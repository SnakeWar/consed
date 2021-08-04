<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PageFormRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Http\Requests\VideosRequest;
use App\Http\Requests\VideosUpdateRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    protected $page;
    protected $title;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
        $this->title = "Páginas";
        $this->subtitle = "Página";
        $this->admin = "admin.pages";
        $this->view = "pages";
        $this->redirect = "admin/pages";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = $this->model->orderBy('id', 'desc')->paginate(10);
        $data = [
            'lista' => $dados,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'view' => $this->view
        ];

        return view($this->admin . '.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'view' => $this->view
            ];
//        dd($data);
        return view($this->admin . '.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageFormRequest $request)
    {
        //dd($request);
        $dataForm = $request->all();
        if(valid_file($request))
        {
            $upload = upload_file($request, 'pages');

            if($upload){
                $dataForm['file'] = $upload;
            }
        }
        $create = $this->model->create($dataForm);

        if(!$create) return redirect()->route($this->view . '.index')->with('fail', 'Houve um problema ao criar o dado!');

        return redirect()->route($this->view . '.index')->with('success', 'dado criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dado = $this->model->find($id);

        return view($this->admin . '.form', compact('dado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dado = $this->model->find($id);
        $data = [
            'dado' => $dado,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'view' => $this->view
            ];

        return view($this->admin . '.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, $id)
    {
        $dado = $this->model->find($id);
        $dataForm = $request->all();
        if(valid_file($request))
        {
            //dd('oxi');
            if(Storage::disk('public')->exists($dado->file)){
                Storage::disk('public')->delete($dado->file);
            }
            $upload = upload_file($request, 'pages');

            if($upload){
                $dataForm['file'] = $upload;
            }
        }
        $update = $dado->update($dataForm);

        if(!$update) return redirect()->route($this->view . '.index')->with('fail', 'Houve um erro ao atualizar os dados!');

        return redirect()->route($this->view . '.index')->with('success', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->model->destroy($id);

        if(!$destroy) return redirect()->route($this->view . '.index')->with('fail', 'Houve um erro ao excluir o dado!');

        return redirect()->route($this->view . '.index')->with('success', 'dado excluído com sucesso!');
    }
    public function ativo($id)
    {
        $model = $this->model->findOrFail($id);
        if($model->status == 0){
            $model->status = 1;
            $model->save();
            return redirect($this->redirect)->with('success', 'Ativado');
        }else{
            $model->status = 0;
            $model->save();
            return redirect($this->redirect)->with('success', 'Desativado');
        }
    }
}
