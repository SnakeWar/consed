<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Message;
use App\Models\Page;
use App\Models\Setting;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::orderBy('title')->get();
        $pages = Page::orderBy('title')->whereStatus(1)->get();

        $menus = Setting::where('key', 'menu')->first();

        $featured = Setting::where('key', 'featured')->first();

        $category_featured = Setting::where('key', 'category_featured')->first();

        $category_secondary = Setting::where('key', 'category_secondary')->first();

        return view('admin.home.home2')->with([
            'categories' => $categories,
            'pages' => $pages,
            'menus' => isset($menus->value) ? json_decode($menus->value) : [],
            'featured' => isset($featured->value) ? json_decode($featured->value) : [],
            'category_featured' => isset($category_featured->value) ? json_decode($category_featured->value) : [],
            'category_secondary' => isset($category_secondary->value) ? json_decode($category_secondary->value) : []
        ]);
    }

    public function index2()
    {
        $categories = Category::orderBy('title')->get();
        $pages = Page::orderBy('title')->whereStatus(1)->get();

        $menus = Setting::where('key', 'menu')->first();

        return view('admin.home.home')->with(['categories' => $categories, 'pages' => $pages, 'menus' => json_decode($menus->value)]);
    }
}
