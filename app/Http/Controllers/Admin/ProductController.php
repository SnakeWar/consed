<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Carbon\Carbon;
use Dotenv\Validator;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Http\Requests\ProductUpdateFormRequest;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Store;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $product;
    protected $title;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->title = "Produtos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->orderBy('id', 'desc')->paginate(10);
        $data = ['lista' => $products, 'title' => $this->title];

        return view('admin.products.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('title')->get();
        $data = ['title' => $this->title, 'subtitle' => 'Criar produto', 'categories' => $categories,  ];
        return view('admin.products.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $dataForm = $request->all();
        //$dataForm['limit_date'] = convertdata_todb($dataForm['limit_date']);


        if(valid_file($request))
        {
            $upload = upload_file($request, 'products');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }


        $create = $this->product->create($dataForm);

        if(!$create) return redirect()->route('products.index')->with('fail', 'Houve um problema ao criar o produto!');

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        return view('admin.products.form', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);
        $categories = Category::orderBy('title')->get();
        $data = ['product' => $product, 'title' => $this->title, 'subtitle' => 'Editar produto', 'categories' => $categories, ];

        return view('admin.products.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateFormRequest $request, $id)
    {
        $product = $this->product->find($id);

        $dataForm = $request->all();
        //$dataForm['limit_date'] = date('Y-m-d');

        if(valid_file($request))
        {
            $upload = upload_file($request, 'products');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $update = $product->update($dataForm);

        if(!$update) return redirect()->route('products.index')->with('fail', 'Houve um erro ao atualizar o produto!');

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->product->destroy($id);

        if(!$destroy) return redirect()->route('products.index')->with('fail', 'Houve um erro ao excluir o produto!');

        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');
    }

    public function photos($id)
    {
        $photos = ProductPhoto::where(['product_id' => $id])->get();
        $data = ['product_id' => $id,  'photos' => $photos, 'title' => 'Fotos', 'subtitle' => 'Adicionar fotos'];

        return view('admin.products.photos')->with($data);
    }

    public function storephotos(Request $request, $id)
    {
        $dataForm = $request->all();

        if(valid_file($request))
        {
            $upload = upload_file($request, 'photos');

            if($upload){
                $dataForm['file'] = $upload;
            }
        }

        if($dataForm['file']){
            $dataForm['product_id'] = $id;
            $photo = ProductPhoto::create($dataForm);
            return response()->json(['status' => 'ok', 'file' => $dataForm['file']]);
        } else {
            throw new RuntimeException('Failed to move uploaded file.');
        }
    }

    public function deletephotos($id)
    {
        $product_id = ProductPhoto::findOrFail($id)->product_id;
        $deleted = ProductPhoto::destroy($id);

        if(!$deleted) return redirect('/admin/products/'.$id.'/photos')->with('fail', 'Falha ao excluir a Foto!');

        return redirect('/admin/products/'.$product_id.'/photos')->with('success', 'Foto excluida com sucesso!');
    }
}
