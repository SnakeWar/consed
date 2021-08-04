<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    protected $contact;
    protected $title;
    protected $module;
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->title   = "Fale Conosco";
        $this->module  = "contacts";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = $this->contact->orderBy('id', 'desc')->paginate(20);
        $data = ['lista' => $lista, 'title' => $this->title, 'module' => $this->module];
        return view('admin.contacts.index')->with($data);
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
        $contact = $this->contact->findOrFail($id);
        $contact->lido = 1;
        $contact->save();
        return view('admin.contacts.form', compact('contact'));
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
        $destroy = $this->contact->destroy($id);
        if (!$destroy) {
            return redirect('/admin/contacts')->with('fail', 'Houve um erro ao excluir o contato!');
        }
        return redirect('/admin/contacts')->with('success', 'Contato excluído com sucesso!');
    }
}
