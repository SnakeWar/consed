<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\HtmlFacade;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use App\Feed\EnhancedFeedItem;

class Product extends Model implements Feedable
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function setTitleAttribute($value)
    {
        $slug = Str::slug($value);
        $matchs = $this->uniqueSlug($slug);
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $matchs ? $slug . '-' . $matchs : $slug;
    }
    public function uniqueSlug($slug)
    {
        $matchs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();
        return $matchs;
    }
    public function photos() {
        return $this->hasMany(ProductPhoto::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function toFeedItem()
    {
        $image = !empty($this->file) ? asset($this->file) : '';
        $image_tag = !empty($image) ? HtmlFacade::image($image) . '<br/>' : '';

        return EnhancedFeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->created_at)
            ->link('/produto/'.$this->slug)
            ->category($this->segment->title)
            ->price($this->price)
            ->mediaContent($image)
            // ->author($this->author->email . " ({$this->author->name})");
            ->author('');
    }

    public static function getAllFeeds() {
        return Product::where('limit_date', '>', (new \DateTime())->format('Y-m-d'))
            ->whereNotNull('price')
            ->orderBy('created_at', 'desc')
            ->with(['segment'])->get();
    }
}
