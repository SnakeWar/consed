<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoGalleryFormRequest;
use App\Http\Requests\Vi;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\VideoGallery;
use App\Models\VideoGalleryItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoGalleryController extends Controller
{
    protected $model;
    protected $title;

    public function __construct(VideoGallery $model)
    {
        $this->model = $model;
        $this->title = 'Galeria de Vídeos';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos_gallery = $this->model->orderBy('id', 'desc')->paginate(10);

        $data = ['model' => $videos_gallery, 'title' => $this->title];

        return view('admin.videos_gallery.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['title' => $this->title, 'subtitle' => 'Adicionar Galeria'];

        return view('admin.videos_gallery.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoGalleryFormRequest $request)
    {
        $dataForm = $request->except(['video']);
        //dd($dataForm['file']);
        $user = Auth::user();
        $dataForm['author_id'] = $user->id;
        $dataForm['date'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['date']);
        
        if(isset($dataForm['capa'])){
            $upload = imageUpload($dataForm['capa'], 'videos_gallery');
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
        if($request->only('video')){
            $item = $request->only('video');
            //dd($item['video']);
            $created->videos()->createMany($item['video']);
        }
        if(!$created) return redirect('admin/videos_gallery')->with('fail', 'Houve um problema ao cadastrar o Vídeo!');

        return redirect('admin/videos_gallery')->with('success', 'Vídeo cadastrado com sucesso!');
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

        $data = ['model' => $model, 'title' => $this->title, 'subtitle' => 'Editar Video Galeria'];

        return view('admin.videos_gallery.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoGalleryFormRequest $request, $id)
    {
        $dataForm = $request->except('video');
        $model = $this->model->findOrFail($id);
        $dataForm['date'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['date']);
        $user = Auth::user();
        $dataForm['author_id'] = $user->id;
    
        if(isset($dataForm['capa'])){
            $upload = imageUpload($dataForm['capa'], 'videos_gallery');
            if($upload){
                $model->photo()->update([
                    'image' => $upload
                ]);
                unset($dataForm['capa']);
            }
        }
        //dd($dataForm);
        if($request->only('video')){
            $item = $request->only('video');
            //dd($item['video']);
            $model->videos()->createMany($item['video']);
        }
        // unset($dataForm['file']);
        // unset($dataForm['capa']);
        $updated = $model->update($dataForm);

        if(!$updated) return redirect('admim/videos_gallery')->with('fail', 'Houve um problema ao editar a Galeria de Vídeo!');

        return redirect('admin/videos_gallery')->with('success', 'Galeria de Vídeo editada com sucesso!');
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

        $deleted = $this->model->destroy($id);

        if(!$deleted) return redirect('admin/videos_gallery')->with('fail', 'Houve um problema ao excluir a Galeria de Vídeo!');

        return redirect('admin/videos_gallery')->with('success', 'Galeria de Vídeo excluída com sucesso!');
    }
    public function removeVideo($id)
    {
        $delete = VideoGalleryItem::findOrFail($id);
        $deleted = $delete->destroy($id);

        if($deleted) return back()->with('success', 'Vídeo excluído com sucesso!');
        return back()->with('fail', 'Houve um problema ao excluir o Vídeo!');
        
    }

}
