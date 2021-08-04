<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    protected $contact;
    protected $title;
    protected $module;
    public function __construct(Newsletter $model)
    {
        $this->model = $model;
        $this->title   = "Novidades";
        $this->module  = "newsletters";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = $this->model->orderBy('id', 'desc')->paginate(20);
        $data = ['lista' => $lista, 'title' => $this->title, 'module' => $this->module];
        return view('admin.newsletters.index')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->findOrFail($id);
        $data->lido = 1;
        $data->save();
        return view('admin.newsletters.form', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->model->destroy($id);
        if (!$destroy) {
            return redirect('/admin/newsletters')->with('fail', 'Houve um erro ao excluir o dado!');
        }
        return redirect('/admin/newsletters')->with('success', 'Dado excluído com sucesso!');
    }

    public function export(Request $request)
    {
        $fileName = 'news.csv';
        $tasks = Newsletter::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Numero');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['email']  = $task->email;

                fputcsv($file, array($row['email']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
