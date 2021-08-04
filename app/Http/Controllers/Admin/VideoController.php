<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\VideosRequest;
use App\Http\Requests\VideosUpdateRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    protected $videos;
    protected $title;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Video $videos)
    {
        $this->videos = $videos;
        $this->title = "Vídeos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = $this->videos->orderBy('id', 'desc')->paginate(10);
        $data = ['lista' => $dados, 'title' => $this->title];

        return view('admin.videos.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('title')->get();
        $data = ['title' => $this->title, 'subtitle' => 'Criar', 'categories' => $categories,  ];
//        dd($data);
        return view('admin.videos.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideosRequest $request)
    {
        $dataForm = $request->all();

        $create = $this->videos->create($dataForm);

        if(!$create) return redirect()->route('videos.index')->with('fail', 'Houve um problema ao criar o dado!');

        return redirect()->route('videos.index')->with('success', 'dado criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dado = $this->videos->find($id);

        return view('adimn.videos.form', compact('dado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dado = $this->videos->find($id);
        $category = Category::orderBy('title')->get();
        $data = ['dado' => $dado, 'title' => $this->title, 'subtitle' => 'Editar ', 'categories' => $category, ];

        return view('admin.videos.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideosUpdateRequest $request, $id)
    {
        $dado = $this->videos->find($id);
        $dataForm = $request->all();

        $update = $dado->update($dataForm);

        if(!$update) return redirect()->route('videos.index')->with('fail', 'Houve um erro ao atualizar os dados!');

        return redirect()->route('videos.index')->with('success', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->videos->destroy($id);

        if(!$destroy) return redirect()->route('videos.index')->with('fail', 'Houve um erro ao excluir o dado!');

        return redirect()->route('videos.index')->with('success', 'dado excluído com sucesso!');
    }
}
