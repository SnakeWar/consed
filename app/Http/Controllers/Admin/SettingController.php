<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingFormRequest;
use App\Models\Setting;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    protected $setting;
    protected $title;

    /**
     * Create a new controller instance.
     *
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
        $this->title = "Settings";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Nothing
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Nothing
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingFormRequest $request)
    {
        $dataForm = $request->all();

        $dataForm['value'] = json_encode($dataForm['value']);

        Setting::where('key', $dataForm['key'])->delete();

        $create = $this->setting->create($dataForm);

        if(!$create) return back()->with('fail', 'Houve um problema ao criar a configuração!');

        return back()->with('success', 'configuração criada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Nothing
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Nothing
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingFormRequest $request, $id)
    {
        // Nothing
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // Nothing
    }
}
