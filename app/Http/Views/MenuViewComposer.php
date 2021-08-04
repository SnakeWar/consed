<?php


namespace App\Http\Views;

use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;

class MenuViewComposer
{
    public function __construct()
    {
        // Nothing
    }

    public function compose($view)
    {
        $menus = Setting::where('key', 'menu')->first();

        $menus = json_decode($menus->value);

        $new_menu = [];


        foreach($menus as $menu) {
            $item = [];

            $item['target'] = $menu->{'open-type'};


            if ($menu->type === 'submenu') {
                $new_submenu = [];

                $item['title'] = $menu->title;

                foreach($menu->submenus as $submenu) {
                    $item_submenu = [];

                    $item_submenu['target'] = $submenu->{'open-type'};

                    if ($submenu->type === 'categories') {
                        $category= Category::where('id', $submenu->id)
                            ->first();

                        $item_submenu['url'] = route('news') . '?category=' . $category->id;
                        $item_submenu['title'] = $category->title;
                    }

                    if ($submenu->type === 'pages') {
                        $page = Page::where('slug', $submenu->id)
                            ->first();

                        $item_submenu['url'] = route('pages', $page->slug);
                        $item_submenu['title'] = $page->title;
                    }

                    if ($submenu->type === 'url') {
                        $item_submenu['url'] = $submenu->url;
                        $item_submenu['title'] = $submenu->title;
                    }

                    if ($item_submenu['target'] === 'popup') {
                        $item_submenu['onclick'] = "window.open('". $item_submenu['url'] ."','popup','width=600,height=600'); return false;";
                        $item_submenu['url'] = "#";
                    }

                    array_push($new_submenu, $item_submenu);
                }

                $item['submenus'] = $new_submenu;
            }
            
            if ($menu->type === 'categories') {
                $category= Category::where('id', $menu->id)
                    ->first();
                
                $item['url'] = route('news') . '?category=' . $category->id;
                $item['title'] = $category->title;
            }
            
            if ($menu->type === 'pages') {
                $page = Page::where('slug', $menu->id)
                    ->first();

                $item['url'] = route('pages', $page->slug);
                $item['title'] = $page->title;
            }

            if ($menu->type === 'url') {
                $item['url'] = $menu->url;
                $item['title'] = $menu->title;
            }
            
            if ($item['target'] === 'popup') {
                $item['onclick'] = "window.open('". $item['url'] ."','popup','width=600,height=600'); return false;";
                $item['url'] = "#";
            }
            
            array_push($new_menu, $item);
        }

        return $view
            ->with('menus', $new_menu);
    }
}