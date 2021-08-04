<?php


namespace App\Http\Views;

use App\Models\Banner;
use App\Models\Poll;
use App\Models\Post;
use App\Models\Video;
use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Category;
use App\User;

class PostViewComposer
{
    private $post;
    private $banner;
    private $video;

    public function __construct(Post $post, Banner $banner, Video $video)
    {
        $this->post = $post;
        $this->banner = $banner;
        $this->video = $video;
    }

    public function compose($view)
    {

        $category_secondary = Setting::where('key', 'category_secondary')->first();

        $category_secondary = json_decode($category_secondary->value);

        $category_secondary = Category::query()

            ->where('id', $category_secondary->category_id)

            ->first();

        $top_comments = Post::with('comments')
            ->whereStatus(1)
            ->whereNotIn('category_id', [$category_secondary->id])
            ->where('published_at', '<=', Carbon::now())
            ->get()
            ->sortByDesc(function($post) {
                return $post->comments->count();
            });
        $top_comments = $top_comments->take(5);

        $recent_posts = $this->post
            ->whereStatus(1)
            ->whereNotIn('category_id', [$category_secondary->id])
            ->where('published_at', '<=', Carbon::now())
            ->Orderby('published_at', 'DESC')
            ->limit(5)
            ->get();

        $top_hits = $this->post
            ->whereStatus(1)
            ->whereNotIn('category_id', [$category_secondary->id])
            ->where('published_at', '<=', Carbon::now())
            ->Orderby('hits', 'DESC')
            ->limit(5)
            ->get();

        $banners = $this->banner
            ->whereStatus(1)
            ->where('type', 'side')
            ->where('published_at', '<=', Carbon::now())
            ->Orderby('published_at', 'DESC')
            ->limit(3)
            ->get();

        $videos = (new Video())->getYoutubeVideos(6, ['none']);

        if (!$videos || empty($videos)) {
            $videos = $this->video
                ->Orderby('created_at', 'DESC')
                ->limit(4)
                ->get();
        }

        $blogs = User::select('users.*')
            ->where('users.category_id', $category_secondary->id)
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->where('posts.status', 1)
            ->where('posts.published_at', '<=', Carbon::now())
            ->where('posts.category_id', $category_secondary->id)
            ->whereNull('posts.deleted_at')
            ->get();

        $poll = Poll::where('status', 1)
            ->where('published_at', '<=', Carbon::now())
            ->where('unpublished_at', '>=', Carbon::now())
            ->orderBy('created_at', 'DESC')
            ->first();

        return $view
            ->with('recent_posts', $recent_posts)
            ->with('top_hits', $top_hits)
            ->with('videos', $videos)
            ->with('top_comments', $top_comments)
            ->with('category_secondary', $category_secondary)
            ->with('blogs', $blogs)
            ->with('poll', $poll)
            ->with('banners', $banners);
    }
}