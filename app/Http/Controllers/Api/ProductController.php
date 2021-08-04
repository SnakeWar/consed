<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
// use Dotenv\Validator;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductApiRequest;
use App\Http\Requests\ProductUpdateApiRequest;
use App\Http\Requests\ProductUpdateFormRequest;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transform\ProductTransform;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator ;
use Illuminate\Support\Facades\Storage ;

class ProductController extends Controller
{
    protected $product;
    protected $product_transform;
    protected $apiRequestValidator;
    protected $apiRequestUpdateValidator;
    protected $title;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product, ProductTransform $product_transform)
    {
        $this->product = $product;
        $this->product_transform = $product_transform;
        $this->apiRequestValidator = new ProductApiRequest();
        $this->apiRequestUpdateValidator = new ProductUpdateApiRequest();
        $this->title = "Produtos";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $store = Store::where('user_id', $request->user()->id)->first();
        $products = $store->products()->orderBy('id', 'desc')->get();//->paginate($request->get('limit', 10));
        
        return response()->json([
            // 'links' => [
            //     'first' => $products->url(0), 
            //     'prev' => $products->previousPageUrl(), 
            //     'next' => $products->nextPageUrl(), 
            //     'last' => $products->url($products->lastPage()), 
            // ], 
            // 'pages' => [
            //     'first' => 0, 
            //     'prev' => $products->currentPage() > 1 ? $products->currentPage() - 1 : null,
            //     'current' => $products->currentPage(),
            //     'next' => $products->currentPage() < $products->lastPage() ? $products->currentPage()+1 : null, 
            //     'last' => $products->lastPage(), 
            // ], 
            // 'total' => $products->total(), 
            'results' => $products->map(function($product) {
                return $this->product_transform->transform($product);
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Criar produto', 'stores' => Store::all(), 'store_id' => $store_id ];
        return view('admin.products.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = Store::where('user_id', $request->user()->id)->first();
        $dataForm = $request->except('access_token');
        $validator = Validator::make($request->all(), $this->apiRequestValidator->rules());
        if ($validator->fails()) {
            return response()->json([
                'success' => false, 
                'errors' => $validator->errors()->all(), 
            ], 401);
        }

        $dataForm['file'] = upload_file_base64($dataForm['file'], 'products');
        if(!empty($dataForm['limit_date'])) {
            $dataForm['limit_date'] = convertdata_todb($dataForm['limit_date']);
        }
        $dataForm['store_id'] = $store->id;
        $dataForm['slug']= Str::slug($dataForm['title']);
        
        $create = $this->product->create($dataForm);

        if(!$create) return response()->json([
            'success' => false, 
            'message' => 'Houve um problema ao criar o produto!', 
        ], 400);

        return response()->json($this->product_transform->transform($create), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $store = Store::where('user_id', $request->user()->id)->first();
        $product = Product::where('id', $id)->where('store_id', $store->id)->first();
        
        if(!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produto não existe!'
            ], 404);
        }

        return response()->json($this->product_transform->transform($product));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($store_id, $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = Store::where('user_id', $request->user()->id)->first();
        $product = Product::where('id', $id)->where('store_id', $store->id)->first();
        
        if(!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produto não existe!'
            ], 404);
        }

        $dataForm = $request->except('access_token');
        $validator = Validator::make($request->all(), $this->apiRequestUpdateValidator->rules());
        if ($validator->fails()) {
            return response()->json([
                'success' => false, 
                'errors' => $validator->errors()->all(), 
            ], 401);
        }

        if(!empty($dataForm['file'])) {
            $dataForm['file'] = upload_file_base64($dataForm['file'], 'products');
        }
        if(!empty($dataForm['limit_date'])) {
            $dataForm['limit_date'] = convertdata_todb($dataForm['limit_date']);
        }
        $dataForm['slug']= Str::slug($dataForm['title']);
        
        $update = $product->update($dataForm);

        if(!$update) return response()->json([
            'success' => false, 
            'message' => 'Houve um problema ao criar o produto!', 
        ], 400);

        return response()->json($this->product_transform->transform($product), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $store = Store::where('user_id', $request->user()->id)->first();
        $destroy = Product::where('id', $id)->where('store_id', $store->id)->delete();

        if(!$destroy) return response()->json([
                'success' => false, 
                'message' => 'Houve um erro ao excluir o produto!', 
            ], 400);
        return response()->json([
            'success' => true, 
            'message' => 'Produto excluído com sucesso!', 
        ], 400);
    }
}
