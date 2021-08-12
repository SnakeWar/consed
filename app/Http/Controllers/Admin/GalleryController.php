<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Requests\GalleryFormRequest;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    protected $model;
    protected $title;

    public function __construct(Gallery $model)
    {
        $this->model = $model;
        $this->title = 'Galerias';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = $this->model->orderBy('id', 'desc')->paginate(10);

        $data = ['model' => $gallery, 'title' => $this->title];

        return view('admin.gallery.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('id', 'desc')->get();
        $data = ['title' => $this->title, 'tags' => $tags, 'subtitle' => 'Adicionar Galeria'];
        return view('admin.gallery.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryFormRequest $request)
    {
        $dataForm = $request->except(['file','tags']);
        $tags = $request->get('tags', null);
        if(isset($dataForm['visible'])){
            $dataForm['visible'] = 1;
        }else{
            $dataForm['visible'] = 0;
        }
        //dd($dataForm['file']);
        $user = Auth::user();
        $dataForm['author_id'] = $user->id;
        $dataForm['date'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['date']);
        
        
        //dd($dataForm);
        if(isset($dataForm['capa'])){
            $upload = imageUpload($dataForm['capa'], 'gallery');
            if($upload){
                $capa = GalleryImage::create([
                    'image' => $upload
                ]);
                $dataForm['cover_id'] = $capa->id;
                unset($dataForm['capa']);
            }
        }
        //dd($dataForm);
        $created = $this->model->create($dataForm);
        
        $created->tags()->sync($tags);

        if($request->hasFile('file')){
            $images = imagesUpload($request->file('file'), 'gallery', 'image');
            $created->photos()->createMany($images);
        }
        if(!$created) return redirect('admin/gallery')->with('fail', 'Houve um problema ao cadastrar a Galeria!');

        return redirect('admin/gallery')->with('success', 'Galeria cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model->findOrFail($id);
        $tags = Tag::orderBy('id', 'desc')->get();
        $data = ['model' => $model, 'title' => $this->title, 'tags' => $tags, 'subtitle' => 'Editar Galeria'];

        return view('admin.gallery.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryFormRequest $request, $id)
    {
        $dataForm = $request->except(['file','tags']);
        $tags = $request->get('tags', null);
        
        if(isset($dataForm['visible'])){
            $dataForm['visible'] = 1;
        }else{
            $dataForm['visible'] = 0;
        }
        $model = $this->model->findOrFail($id);
        $dataForm['date'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['date']);
        $user = Auth::user();
        $dataForm['author_id'] = $user->id;
    
        if(isset($dataForm['capa'])){
            if(Storage::disk('public')->exists($model->photo->image)){
                Storage::disk('public')->delete($model->photo->image);
            }
            $upload = imageUpload($dataForm['capa'], 'gallery');
            if($upload){
                $model->photo()->update([
                    'image' => $upload
                ]);
                unset($dataForm['capa']);
                //$dataForm['cover_id'] = $capa->id;
            }
        }
        if($request->hasFile('file')){
            $images = imagesUpload($request->file('file'), 'gallery', 'image');
            $model->photos()->createMany($images);
        }
        // unset($dataForm['file']);
        // unset($dataForm['capa']);
        if(!is_null($tags))
        $model->tags()->sync($tags);
        $updated = $model->update($dataForm);

        if(!$updated) return redirect('admim/gallery')->with('fail', 'Houve um problema ao editar a Galeria!');

        return redirect('admin/gallery')->with('success', 'Galeria editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        if(!$model->delete()) return redirect('admin/gallery')->with('fail', 'Não é possível excluir! Existem registros associados');

        $deleted = $this->model->destroy($id);

        if(!$deleted) return redirect('admin/gallery')->with('fail', 'Houve um problema ao excluir a Galeria!');

        return redirect('admin/gallery')->with('success', 'Galeria excluída com sucesso!');
    }
    public function removePhoto($id)
    {
        $model = GalleryImage::findOrFail($id);
        if(Storage::disk('public')->exists($model->image)){
            Storage::disk('public')->delete($model->image);
        }
        $deleted = $model->destroy($id);

        if($deleted) return back()->with('success', 'Foto excluída com sucesso!');
        return back()->with('fail', 'Houve um problema ao excluir a Foto!');
        
    }

}
