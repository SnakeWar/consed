<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagFormRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $model;
    protected $title;

    public function __construct(Tag $model)
    {
        $this->model = $model;
        $this->title = 'Tags';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->model->orderBy('id', 'desc')->paginate(10);

        $data = ['tags' => $tags, 'title' => $this->title];

        return view('admin.tags.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar Tag'];

        return view('admin.tags.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagFormRequest $request)
    {
        $dataForm = $request->all();

        $created = $this->model->create($dataForm);

        if(!$created) return redirect('admin/tags')->with('fail', 'Houve um problema ao cadastrar a Tag!');

        return redirect('admin/tags')->with('success', 'Tag cadastrada com sucesso!');
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
        $tag = $this->model->findOrFail($id);

        $data = ['tag' => $tag, 'title' => $this->title, 'subtitle' => 'Editar Tag'];

        return view('admin.tags.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $tag = $this->model->findOrFail($id);

        $updated = $tag->update($dataForm);

        if(!$updated) return redirect('admim/tags')->with('fail', 'Houve um problema ao editar a Tag!');

        return redirect('admin/tags')->with('success', 'Tag editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = $this->model->findOrFail($id);
        if(!$tag->canDelete()) return redirect('admin/tags')->with('fail', 'Não é possível excluir! Existem registros associados');

        $deleted = $this->model->destroy($id);

        if(!$deleted) return redirect('admin/tags')->with('fail', 'Houve um problema ao excluir a Tag!');

        return redirect('admin/tags')->with('success', 'Tag excluída com sucesso!');
    }

}
