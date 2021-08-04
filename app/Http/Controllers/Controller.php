<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $model = $this->model->orderBy('id', 'desc')->paginate(10);
        $view = 'admin.'.$this->title.'.index';
        $data = ['lista' => $model, 'title' => $this->title];

        return view($view)->with($data);
    }*/
}
