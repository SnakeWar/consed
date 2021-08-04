<?php



namespace App\Http\Controllers\Pages;



use App\Http\Requests\CommentCreateRequest;

use App\Http\Requests\NewsletterFormRequest;

use App\Models\Alternative;
use App\Models\Banner;

use App\Models\Category;

use App\Models\Comment;

use App\Models\Newsletter;

use App\Models\Page;

use App\Models\Photos;

use App\Models\Poll;
use App\Models\Post;

use App\Models\Response;

use App\Models\Setting;

use App\Models\Video;

use App\Http\Controllers\Controller;

use App\Models\Product;

use App\Models\Vote;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;



class PagesController extends Controller

{



    protected $post;

    protected $category;

    protected $product;

    protected $videos;

    protected $photos;

    protected $pages;

    protected $banner;



    public function __construct(Post $post, Product $product, Video $videos, Photos $photos, Page $page, Category $category, Banner $banner)

    {

        $this->post = $post;

        $this->product = $product;

        $this->videos = $videos;

        $this->photos = $photos;

        $this->pages = $page;

        $this->category = $category;

        $this->banner = $banner;

    }



    public function index()

    {


        $category_secondary = Setting::where('key', 'category_secondary')->first();

        $category_secondary = json_decode($category_secondary->value);

        $featureds =  $this->post

            ->where('type', 1)

            ->whereStatus(1)

            ->whereNotNull('file')

            ->where('published_at', '<=', Carbon::now())

            ->whereNotIn('category_id', [$category_secondary->category_id])

            ->with('category')

            ->orderBy('published_at', 'DESC')

            ->limit(3)

            ->get();



        $posts_1 = $this->post

            ->whereStatus(1)

            ->where('type', 0)

            ->whereNotNull('file')

            ->where('published_at', '<=', Carbon::now())

            ->whereNotIn('category_id', [$category_secondary->category_id])

            ->with('category')

            ->orderBy('published_at', 'DESC')

            ->limit(4)

            ->get();



        $posts_2 = $this->post

            ->whereStatus(1)

            ->where('type', 0)

            ->whereNotIn('id', $posts_1->pluck('id'))

            ->where('published_at', '<=', Carbon::now())

            ->whereNotIn('category_id', [$category_secondary->category_id])

            ->with('category')

            ->orderBy('published_at', 'DESC')

            ->limit(5)

            ->get();


        $category_featured = Setting::where('key', 'category_featured')->first();

        $category_featured = json_decode($category_featured->value);

        $category = $this->category

            ->where('id', $category_featured->category_id)

            ->first();



        $category_items = $this->post

            ->whereStatus(1)

            ->where('category_id', $category_featured->category_id)

            ->whereNotIn('id', array_merge($posts_1->pluck('id')->toArray(), $posts_2->pluck('id')->toArray(), $featureds->pluck('id')->toArray()))

            ->whereNotNull('file')

            ->where('published_at', '<=', Carbon::now())

            ->with('category')

            ->orderBy('published_at', 'DESC')

            ->limit(3)

            ->get();



        $others_1 = $this->post

            ->whereStatus(1)

            ->where('type', 2)

            ->whereNotIn('id', $category_items->pluck('id')->toArray())

            ->whereNotNull('file')

            ->where('published_at', '<=', Carbon::now())

            ->whereNotIn('category_id', [$category_secondary->category_id])

            ->with('category')

            ->orderBy('published_at', 'DESC')

            ->limit(4)

            ->get();



        $others_2 = $this->post

            ->whereStatus(1)

            ->where('type', 2)

            ->whereNotIn('id', array_merge($category_items->pluck('id')->toArray(), $others_1->pluck('id')->toArray()))

            ->whereNotNull('file')

            ->where('published_at', '<=', Carbon::now())

            ->whereNotIn('category_id', [$category_secondary->category_id])

            ->with('category')

            ->orderBy('published_at', 'DESC')

            ->limit(9)

            ->get();



        $banners = $this->banner

            ->whereStatus(1)

            ->where('type', 'between_posts')

            ->where('published_at', '<=', Carbon::now())

            ->Orderby('published_at', 'DESC')

            ->limit(4)

            ->get();

        $popup = $this->banner

            ->whereStatus(1)

            ->where('type', 'popup')

            ->where('published_at', '<=', Carbon::now())

            ->Orderby('published_at', 'DESC')

            ->limit(1)

            ->get();

        $top_comments = Post::with('comments')
            ->whereStatus(1)
            ->where('published_at', '<=', Carbon::now())
            ->whereNotIn('category_id', [$category_secondary->category_id])
            ->get()
            ->sortByDesc(function($post) {
                return $post->comments->count();
        });
        $top_comments = $top_comments->take(5);

        $recent_posts = $this->post
            ->whereStatus(1)
            ->where('published_at', '<=', Carbon::now())
            ->whereNotIn('category_id', [$category_secondary->category_id])
            ->Orderby('published_at', 'DESC')
            ->limit(5)
            ->get();

        $top_hits = $this->post
            ->whereStatus(1)
            ->where('published_at', '<=', Carbon::now())
            ->whereNotIn('category_id', [$category_secondary->category_id])
            ->Orderby('hits', 'DESC')
            ->limit(5)
            ->get();

        $category_secondary = Setting::where('key', 'category_secondary')->first();

        $category_secondary = json_decode($category_secondary->value);

        $category_secondary = Category::query()

            ->where('id', $category_secondary->category_id)

            ->first();

        $blogs = User::select('users.*')
            ->where('users.category_id', $category_secondary->id)
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->whereStatus(1)
            ->where('published_at', '<=', Carbon::now())
            ->where('posts.category_id', $category_secondary->id)
            ->whereNotNull('posts.id')
            ->get();

        $featured = Setting::where('key', 'featured')->first();

        $lives = (new Video())->getYoutubeVideos(20, ['live', 'upcoming']);
        
        return view('pages.index',

            [

                'featureds' => $featureds,

                'posts_1' => $posts_1,

                'posts_2' => $posts_2,

                'category' => $category,

                'category_items' => $category_items,

                'others_1' => $others_1,

                'others_2' => $others_2,

                'banners' => $banners,

                'featured' => isset($featured->value) ? json_decode($featured->value) : [],

                'popup' => $popup,

                'top_comments' => $top_comments,

                'recent_posts' => $recent_posts,

                'top_hits' => $top_hits,

                'category_secondary' => $category_secondary,

                'blogs' => $blogs,

                'lives' => $lives

            ]

        );

    }



    public function news(Request $request)

    {

        $category_secondary = Setting::where('key', 'category_secondary')->first();

        $category_secondary = json_decode($category_secondary->value);

        $categoryId = $request->query('category');

        $blogId = $request->query('blog');

        $posts = $this->post::whereStatus(1)
            ->where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'DESC');

        if (isset($request['buscarNoticia'])) {

            $posts = $posts->where('title', 'LIKE', "%{$request['buscarNoticia']}%");

        }

        if (!empty($blogId)) {
            $posts = $posts
                ->where('category_id', $category_secondary->category_id)
                ->where('user_id', $blogId);
        } else {
            $posts = $posts->whereNotIn('category_id', [$category_secondary->category_id]);
        }


        if (!empty($categoryId)) {

            $posts = $posts->where('category_id', $categoryId);

        }



        return view('pages.news',

            ['posts' => $posts->paginate(20)]

        );

    }



    public function news_detail($slug)

    {

        $post = $this->post::with('comments')

            ->whereSlug($slug)

            ->whereStatus(1)

            ->where('published_at', '<=', Carbon::now())

            ->first();



        $post->hits = $post->hits + 1;


        $related = $this->post
            ->where('category_id', $post->category_id)
            ->whereStatus(1)
            ->limit(8)
            ->get();

        return $post->update(['hits' => $post->hits]) ? view('pages.news_detail',

            ['post' => $post, 'related' => $related]

        ) : back();

    }



    public function pages($slug)

    {

        $page = $this->pages::whereSlug($slug)

            ->whereStatus(1)

            ->first();

        return view('pages.pages', [ 'page' => $page ]);

    }



    public function comments(CommentCreateRequest $request) {



        $dataForm = $request->all();



        $contact = Comment::create($dataForm);



        if($contact):

            return back()->with('success', 'Mensagem enviada, agradaçemos seu contato.');

        else:

            return back()->with('fail', 'Problemas para enviar sua mensagem.');

        endif;



    }



    public function response(CommentCreateRequest $request) {



        $dataForm = $request->all();



        $contact = Response::create($dataForm);



        if($contact):

            return back()->with('success', 'Mensagem enviada, agradaçemos seu contato.');

        else:

            return back()->with('fail', 'Problemas para enviar sua mensagem.');

        endif;



    }



    public function videos()

    {

        $videos = (new Video())->getYoutubeVideos(15);

        if (!$videos || empty($videos)) {
            $videos = $this->videos::paginate(6);
        }


        return view('pages.videos',

            ['videos' => $videos]

        );

    }



    public function newsletter(NewsletterFormRequest $request)

    {

        $dataForm = $request->only('email');



        $dados = Newsletter::create($dataForm);



        if($dados):

            return back()->with('success', 'Inscrição feita com sucesso.');

        else:

            return back()->with('fail', 'Problemas para enviar sua mensagem.');

        endif;

    }



    public function banner_hit($slug)

    {

        $banner = $this->banner

            ->whereSlug($slug)

            ->first();



        $banner->hits = $banner->hits + 1;



        return $banner->update(['hits' => $banner->hits]) ? redirect()->to($banner->url) : back();

    }

    public function enquete(){

        $enquete = Poll::where('status', 1)
            ->where('published_at', '<=', Carbon::now())
            ->where('unpublished_at', '>=', Carbon::now())
            ->with(['alternatives'])
            ->orderBy('created_at', 'DESC')
            ->first();

        return view('pages.enquete')->with([
            'enquete' => $enquete
        ]);

        //$dados = $request->all();
        //$dados = $request->except('_token');
    }


    public function enquete_send(Request $request){

        $ip_visitante = $request->ip();

        $data = $request->all();
        $data = $request->except('_token');

        $existing_vote = Vote::where('poll_id', $data['id_poll'])
            ->where('ip', $ip_visitante)->first();

        if($existing_vote) {
            return response()->json(['status' => 400, 'message' => "Você já votou nessa enquete. Por favor, tente novamente mais tarde."]);
        }else{
            $enqueteVoto = Alternative::where('id', $data['id_alternative'])->increment('votes', 1);
            if($enqueteVoto){
                Vote::create([
                    'alternative_id' => $data['id_alternative'],
                    'poll_id' => $data['id_poll'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'telephone' => $data['telephone'],
                    'ip' => $ip_visitante,
                ]);
                $poll = Poll::where('id', $data['id_poll'])->with(['alternatives'])->first();
                $votos = Alternative::where('poll_id', $data['id_poll'])->selectRaw('sum(votes) as total')->first();
                return response()->json(['status' => 200, 'message' => "Obrigado! Voto computado com sucesso.", 'dados' =>  compact(['poll', 'votos']) ]);
            }else{
                return response()->json(['status' => 400, 'message' => "Tente novamente, mais tarde."]);
            }
        }


        //return $data;
    }

}

