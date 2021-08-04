<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerUpdateFormRequest;
use App\Http\Requests\BannerFormRequest;
use App\Models\Banner;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    protected $banner;
    protected $title;

    /**
     * Create a new controller instance.
     *
     * @param Banner $banner
     */
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
        $this->title = "Banners";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banners = $this->banner->orderBy('id', 'desc')->paginate(10);
        $data = ['lista' => $banners, 'title' => $this->title];

        return view('admin.banners.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Criar banner' ];
        return view('admin.banners.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerFormRequest $request)
    {

        $dataForm = $request->all();
        $dataForm['published_at'] = convertdata_todb($dataForm['published_at']);

        if(valid_file($request))
        {
            if ($request->has('file')) {
                $upload = upload_file($request, 'banners');

                if($upload){
                    $dataForm['file'] = $upload;
                    unset($dataForm['image']);
                }
            }

            if ($request->has('file_mobile')) {
                $upload = null;

                $upload = upload_file($request, 'banners', 'file_mobile');

                if($upload){
                    $dataForm['file_mobile'] = $upload;
                    unset($dataForm['image']);
                }
            }
        }

        $create = $this->banner->create($dataForm);

        if(!$create) return redirect()->route('banners.index')->with('fail', 'Houve um problema ao criar o banner!');

        return redirect()->route('banners.index')->with('success', 'banner criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = $this->banner->find($id);

        return view('adimn.banners.form', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = $this->banner->find($id);

        $data = ['banner' => $banner, 'title' => $this->title, 'subtitle' => 'Editar banner'];

        return view('admin.banners.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdateFormRequest $request, $id)
    {
        $banner = $this->banner->find($id);

        $dataForm = $request->all();

        $dataForm['published_at'] = convertdata_todb($dataForm['published_at']);

        if(valid_file($request))
        {
            if ($request->has('file')) {
                $upload = upload_file($request, 'banners');

                if($upload){
                    $dataForm['file'] = $upload;
                    unset($dataForm['image']);
                }
            }

            if ($request->has('file_mobile')) {
                $upload = null;

                $upload = upload_file($request, 'banners', 'file_mobile');

                if($upload){
                    $dataForm['file_mobile'] = $upload;
                    unset($dataForm['image']);
                }
            }
        }

        $update = $banner->update($dataForm);

        if(!$update) return redirect()->route('banners.index')->with('fail', 'Houve um erro ao atualizar a banner!');

        return redirect()->route('banners.index')->with('success', 'Banner atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->banner->destroy($id);

        if(!$destroy) return redirect()->route('banners.index')->with('fail', 'Houve um erro ao excluir a banner!');

        return redirect()->route('banners.index')->with('success', 'Banner excluído com sucesso!');
    }

    public function ativo($id)
    {
        $model = $this->banner->findOrFail($id);
        if($model->status == 0){
            $model->status = 1;
            $model->save();
            return redirect('admin/banners')->with('success', 'Ativado');
        }else{
            $model->status = 0;
            $model->save();
            return redirect('admin/banners')->with('success', 'Desativado');
        }
    }
}
