<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    protected $title;

    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->title = 'Categorias';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->orderBy('id', 'desc')->paginate(10);

        $data = ['categories' => $categories, 'title' => $this->title];

        return view('admin.categories.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar Categoria'];

        return view('admin.categories.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        $dataForm = $request->all();

        $created = $this->category->create($dataForm);

        if(!$created) return redirect('admin/categories')->with('fail', 'Houve um problema ao cadastrar a Categoria!');

        return redirect('admin/categories')->with('success', 'Categoria cadastrada com sucesso!');
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
        $category = $this->category->findOrFail($id);

        $data = ['category' => $category, 'title' => $this->title, 'subtitle' => 'Editar Categoria'];

        return view('admin.categories.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $category = $this->category->findOrFail($id);

        $updated = $category->update($dataForm);

        if(!$updated) return redirect('admim/categories')->with('fail', 'Houve um problema ao editar a Categoria!');

        return redirect('admin/categories')->with('success', 'Categoria editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        if(!$category->canDelete()) return redirect('admin/categories')->with('fail', 'Não é possível excluir! Existem registros associados');

        $deleted = $this->category->destroy($id);

        if(!$deleted) return redirect('admin/categories')->with('fail', 'Houve um problema ao excluir a Categoria!');

        return redirect('admin/categories')->with('success', 'Categoria excluída com sucesso!');
    }

}
