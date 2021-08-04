<?php


namespace App\Http\Views;

use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;

class FooterViewComposer
{
    public function __construct()
    {
        // Nothing
    }

    public function compose($view)
    {
        $categories = Category::whereNull('deleted_at')->get()->toArray();


        $categories = array_chunk($categories, 5, false);

        return $view->with('categories', $categories);
    }
}