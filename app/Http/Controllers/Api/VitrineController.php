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
use App\Models\Segment;
use App\Models\Transform\ProductTransform;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator ;
use Illuminate\Support\Facades\Storage ;

class VitrineController extends Controller
{
    protected $product;
    protected $product_transform;
    protected $apiRequestValidator;
    protected $apiRequestUpdateValidator;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product, ProductTransform $product_transform)
    {
        $this->product = $product;
        $this->product_transform = $product_transform;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products(Request $request)
    {
        $products = Product::with('store', 'store.segment')
            ->where('limit_date', '>', (new \DateTime())->format('Y-m-d'))
            ->orderBy('id', 'desc')->get();
        
        return response()->json([
            'results' => $products->map(function($product) {
                return $this->product_transform->transform($product);
            })
        ]);
    }

    public function stores(Request $request) {
        $stores = Store::all();
        return response()->json(['results' => $stores, ]);
    }
    
    public function segments(Request $request) {
        $segments = Segment::all();
        return response()->json(['results' => $segments, ]);
    }

    public function products_filter(Request $request) {
        $data = $request->all();

        $orderBy = empty($data['order']) ? 'asc' : $data['order'];
        
        $product_query = Product::with('store', 'store.segment')->where('limit_date', '>', (new \DateTime())->format('Y-m-d'))->orderBy('price', $orderBy);

        if(!empty($data['store_id'])) {
            $product_query = $product_query->where('store_id', $data['store_id']);
        }

        if(!empty($data['segment_id'])) {
            $segment_id = $data['segment_id'];
            $product_query = $product_query->whereHas('store', function ($query) use($segment_id) {
                $query->where('segment_id', $segment_id);
            });
        }

        $products = $product_query->get();
        return response()->json(['results' => $products->map(function($product) {
            return $this->product_transform->transform($product);
        }), ]);
    }

}
