<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\PublicUtilityRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\PublicUtility;

class PublicUtilityController extends Controller
{
    protected $public_utility;
    protected $title;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PublicUtility $publicUtility)
    {
        $this->public_utility = $publicUtility;
        $this->title = "Utilidade Pública";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = $this->public_utility->orderBy('id', 'desc')->paginate(10);
        $data = ['lista' => $dados, 'title' => $this->title];

        return view('admin.public_utilities.index')->with($data);
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
        return view('admin.public_utilities.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicUtilityRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['published_at'] = convertdata_todb($dataForm['published_at']);
        if(valid_file($request))
        {
            $upload = upload_file($request, 'public_utilities');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }


        $create = $this->public_utility->create($dataForm);

        if(!$create) return redirect()->route('public_utilities.index')->with('fail', 'Houve um problema ao criar a postagem!');

        return redirect()->route('public_utilities.index')->with('success', 'Postagem criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dado = $this->public_utility->find($id);

        return view('adimn.public_utilities.form', compact('dado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dado = $this->public_utility->find($id);
        $category = Category::orderBy('title')->get();
        $data = ['dado' => $dado, 'title' => $this->title, 'subtitle' => 'Editar ', 'categories' => $category, ];

        return view('admin.public_utilities.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublicUtilityUpdateRequest $request, $id)
    {
        $dado = $this->public_utility->find($id);
        $dataForm = $request->all();
        $dataForm['published_at'] = convertdata_todb($dataForm['published_at']);
        //$dataForm['limit_date'] = date('Y-m-d');

        if(valid_file($request))
        {
            $upload = upload_file($request, 'public_utilities');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $update = $dado->update($dataForm);

        if(!$update) return redirect()->route('public_utilities.index')->with('fail', 'Houve um erro ao atualizar os dados!');

        return redirect()->route('public_utilities.index')->with('success', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->public_utility->destroy($id);

        if(!$destroy) return redirect()->route('public_utilities.index')->with('fail', 'Houve um erro ao excluir a postagem!');

        return redirect()->route('public_utilities.index')->with('success', 'Postagem excluído com sucesso!');
    }
}
