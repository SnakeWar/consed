<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\News;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewFormRequest;
use App\Models\Copyright;
use App\Models\Gallery;
use App\Models\Section;
use App\Models\VideoGallery;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NewController extends Controller
{
    protected $model;
    protected $title;
    protected $category;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(News $new)
    {
        $this->model = $new;
        $this->title = "Notícias";
    }

    public function index()
    {
        $user = Auth::user();

        $posts = $this->model->orderBy('id', 'desc')->with('user')->paginate(50);

        $data = ['lista' => $posts, 'title' => $this->title];

        return view('admin.news.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $tags = Tag::orderBy('id', 'desc')->get();
        $sections = Section::orderBy('id', 'desc')->get();
        $galleries = Gallery::orderBy('id', 'desc')->get();
        $videosgallery = VideoGallery::orderBy('id', 'desc')->get();
        $copyright = Copyright::orderBy('id', 'desc')->get();
        $data = [
            'title' => $this->title,
            'subtitle' => 'Criar notícia',
            'user' => $user,
            'tags' => $tags,
            'sections' => $sections,
            'galleries' => $galleries,
            'videosgallery' => $videosgallery,
            'copyright' => $copyright
            ];
        return view('admin.news.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewFormRequest $request)
    {
        $dataForm = $request->all();
        $tags = $request->get('tags', null);
        $sections = $request->get('sections', null);
        if(isset($dataForm['visible'])){
            $dataForm['visible'] = 1;
        }else{
            $dataForm['visible'] = 0;
        }
        //dd($dataForm);
        $dataForm['publication'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['publication']);
        //$dataForm['description'] = !empty($dataForm['description']) ? $dataForm['description'] : '';

        $user = Auth::user();

        $dataForm['author_id'] = $user->id;
        $create = $this->model->create($dataForm);
        
        $create->tags()->sync($tags);
        $create->sections()->sync($sections);

        if(valid_file($request))
        {
            $upload = upload_file($request, 'news');

            if($upload){
                $image = $create->photo()->create([
                    'image' => $upload,
                ]);
                $dataForm['cover_id'] = $image->id;
            }
        }
            
        if(!$create->update($dataForm)) return redirect()->route('news.index')->with('fail', 'Houve um problema ao criar a postagem!');

        return redirect()->route('news.index')->with('success', 'Postagem criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->model->find($id);

        return view('adimn.news.form', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $tags = Tag::orderBy('id', 'desc')->get();
        $sections = Section::orderBy('id', 'desc')->get();
        $galleries = Gallery::orderBy('id', 'desc')->get();
        $videosgallery = VideoGallery::orderBy('id', 'desc')->get();
        $copyright = Copyright::orderBy('id', 'desc')->get();
        $model = $this->model->find($id);
        //dd($model);
        $data = ['post' => $model,
         'title' => $this->title,
          'subtitle' => 'Editar postagem',
            'user' => $user,
            'tags' => $tags,
            'sections' => $sections,
            'galleries' => $galleries,
            'videosgallery' => $videosgallery,
            'copyright' => $copyright
        ];

        return view('admin.news.form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewFormRequest $request, $id)
    {
        $model = $this->model->find($id);

        $dataForm = $request->except('tags');
        $tags = $request->get('tags', null);
        $sections = $request->get('sections', null);
        if(isset($dataForm['visible'])){
            $dataForm['visible'] = 1;
        }else{
            $dataForm['visible'] = 0;
        }
        $user = Auth::user();
        $dataForm['author_id'] = $user->id;
        $dataForm['publication'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['publication']);
        if(valid_file($request))
        {
            $upload = upload_file($request, 'news');

            if($upload){
                $model->photo()->update([
                    'image' => $upload,
                ]);
                //$dataForm['cover_id'] = $image->id;
            }
        }
        //dd($tags);
        if(!is_null($tags))
        $model->tags()->sync($tags);
        if(!is_null($sections))
        $model->tags()->sync($sections);

        $update = $model->update($dataForm);
        
        if(!$update) return redirect()->route('news.index')->with('fail', 'Houve um erro ao atualizar a postagem!');

        return redirect()->route('news.index')->with('success', 'Postagem atualizado com sucesso!');
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

        if(!$destroy) return redirect()->route('news.index')->with('fail', 'Houve um erro ao excluir a postagem!');

        return redirect()->route('news.index')->with('success', 'Postagem excluído com sucesso!');
    }

    // public function photos($id)
    // {
    //     $photos = ProductPhoto::where(['product_id' => $id])->get();
    //     $data = ['product_id' => $id,  'photos' => $photos, 'title' => 'Fotos', 'subtitle' => 'Adicionar fotos'];

    //     return view('admin.products.photos')->with($data);
    // }
    public function ativo($id)
    {
        $model = $this->model->findOrFail($id);
        if($model->visible == 0){
            $model->visible = 1;
            $model->save();
            return redirect('admin/news')->with('success', 'Notícia Ativada');
        }else{
            $model->visible = 0;
            $model->save();
            return redirect('admin/news')->with('success', 'Notícia Desativada');
        }
    }
    public function destaque($id)
    {
        $model = $this->model->findOrFail($id);
        if($model->highlight == 0){
            $model->highlight = 1;
            $model->save();
            return redirect('admin/news')->with('success', 'Notícia agora é destaque');
        }else{
            $model->highlight = 0;
            $model->save();
            return redirect('admin/news')->with('success', 'Notícia deixou de ser destaque');
        }
    }
}
