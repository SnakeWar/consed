<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\PhotosRequest;
use App\Http\Requests\PublicUtilityRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Photos;
use App\Models\PublicUtility;

class PhotosController extends Controller
{
    protected $photos;
    protected $title;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Photos $photos)
    {
        $this->photos = $photos;
        $this->title = "Fotos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = $this->photos->orderBy('id', 'desc')->paginate(10);
        $data = ['lista' => $dados, 'title' => $this->title];

        return view('admin.photos.index')->with($data);
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
        return view('admin.photos.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotosRequest $request)
    {
        $dataForm = $request->all();
        if(valid_file($request))
        {
            $upload = upload_file($request, 'photos');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }


        $create = $this->photos->create($dataForm);

        if(!$create) return redirect()->route('photos.index')->with('fail', 'Houve um problema ao criar o dado!');

        return redirect()->route('photos.index')->with('success', 'dado criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dado = $this->photos->find($id);

        return view('adimn.photos.form', compact('dado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dado = $this->photos->find($id);
        $category = Category::orderBy('title')->get();
        $data = ['dado' => $dado, 'title' => $this->title, 'subtitle' => 'Editar ', 'categories' => $category, ];

        return view('admin.photos.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhotosUpdateRequest $request, $id)
    {
        $dado = $this->photos->find($id);
        $dataForm = $request->all();
        //$dataForm['limit_date'] = date('Y-m-d');

        if(valid_file($request))
        {
            $upload = upload_file($request, 'photos');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $update = $dado->update($dataForm);

        if(!$update) return redirect()->route('photos.index')->with('fail', 'Houve um erro ao atualizar os dados!');

        return redirect()->route('photos.index')->with('success', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->photos->destroy($id);

        if(!$destroy) return redirect()->route('photos.index')->with('fail', 'Houve um erro ao excluir o dado!');

        return redirect()->route('photos.index')->with('success', 'dado excluído com sucesso!');
    }
}
