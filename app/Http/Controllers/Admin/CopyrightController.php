<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Requests\CopyrightFormRequest;
use App\Models\Copyright;
use Illuminate\Http\Request;

class CopyrightController extends Controller
{
    protected $model;
    protected $title;

    public function __construct(Copyright $model)
    {
        $this->model = $model;
        $this->title = 'Copyrights';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = $this->model->orderBy('id', 'desc')->paginate(10);

        $data = ['lista' => $lista, 'title' => $this->title];

        return view('admin.copyrights.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar Copyright'];

        return view('admin.copyrights.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CopyrightFormRequest $request)
    {
        $dataForm = $request->all();

        $created = $this->model->create($dataForm);

        if(!$created) return redirect('admin/copyrights')->with('fail', 'Houve um problema ao cadastrar a Copyright!');

        return redirect('admin/copyrights')->with('success', 'Copyright cadastrada com sucesso!');
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

        $data = ['model' => $model, 'title' => $this->title, 'subtitle' => 'Editar Copyright'];

        return view('admin.copyrights.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CopyrightFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $model = $this->model->findOrFail($id);

        $updated = $model->update($dataForm);

        if(!$updated) return redirect('admim/copyrights')->with('fail', 'Houve um problema ao editar a Copyright!');

        return redirect('admin/copyrights')->with('success', 'Copyright editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        if(!$model->canDelete()) return redirect('admin/copyrights')->with('fail', 'Não é possível excluir! Existem registros associados');

        $deleted = $this->model->destroy($id);

        if(!$deleted) return redirect('admin/copyrights')->with('fail', 'Houve um problema ao excluir a Copyright!');

        return redirect('admin/copyrights')->with('success', 'Copyright excluída com sucesso!');
    }

}
