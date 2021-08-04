<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostUpdateFormRequest;
use App\Http\Requests\PostFormRequest;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\New;
use App\Models\ProductPhoto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PostController extends Controller
{
    protected $model;
    protected $title;
    protected $category;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(New $new)
    {
        $this->model = $new;
        $this->title = "Notícias";
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $posts = $this
            ->model
            ->orderBy('id', 'desc')
            ->when(!empty($user->category_id), function ($q) use ($user) {
                return $q->where('category_id', $user->category_id)
                    ->where('user_id', $user->id);
            })
            ->when($request->has('type') && ($request->query('type') || $request->query('type') === '0'), function ($q) use ($request) {
                return $q->where('type', intval($request->query('type')));
            })
            ->when($request->has('title') && $request->query('title'), function ($q) use ($request) {
                return $q->where('title', 'LIKE', "%{$request->query('title')}%");
            })
            ->paginate(10);

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
        $galleries = Gallery::orderBy('id', 'desc')->get();
        $videosgallery = VideoGallery::orderBy('id', 'desc')->get();
        $copyright = Copyright::orderBy('id', 'desc')->get();
        $data = [
            'title' => $this->title,
            'subtitle' => 'Criar postagem',
            'user' => $user,
            'tags' => $tags,
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
    public function store(PostFormRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['published_at'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['published_at']);
        $dataForm['description'] = !empty($dataForm['description']) ? $dataForm['description'] : '';

        $user = Auth::user();

        $dataForm['user_id'] = $user->id;

        if (!empty($user->category_id)) {
            $dataForm['category_id'] = $user->category_id;
            $dataForm['type'] = 2;
        }

        if(valid_file($request))
        {
            $upload = upload_file($request, 'posts');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $create = $this->model->create($dataForm);

        if(!$create) return redirect()->route('news.index')->with('fail', 'Houve um problema ao criar a postagem!');

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

        return view('adimn.news.form', compact('post'));
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
        $galleries = Gallery::orderBy('id', 'desc')->get();
        $videosgallery = VideoGallery::orderBy('id', 'desc')->get();
        $copyright = Copyright::orderBy('id', 'desc')->get();
        $model = $this->model->find($id);
        $category = Category::orderBy('title')->get();
        $data = ['post' => $model,
         'title' => $this->title,
          'subtitle' => 'Editar postagem',
            'user' => $user,
            'tags' => $tags,
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
    public function update(PostUpdateFormRequest $request, $id)
    {
        $model = $this->model->find($id);

        $dataForm = $request->all();

        $dataForm['publication'] = Carbon::createFromFormat('d/m/Y H:i', $dataForm['publication']);
//        $dataForm['description'] = !empty($dataForm['description']) ? $dataForm['description'] : '';
        if(valid_file($request))
        {
            $upload = upload_file($request, 'news');

            if($upload){
                $dataForm['file'] = $upload;
                unset($dataForm['image']);
            }
        }

        $user = Auth::user();

        if (!empty($user->category_id)) {
            $dataForm['category_id'] = $user->category_id;
            $dataForm['type'] = 2;
        }

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
            return redirect('admin/news')->with('success', 'Ativado');
        }else{
            $model->visible = 0;
            $model->save();
            return redirect('admin/news')->with('success', 'Desativado');
        }
    }
}
