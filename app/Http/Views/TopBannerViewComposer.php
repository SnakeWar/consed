<?php


namespace App\Http\Views;

use App\Models\Banner;
use Carbon\Carbon;

class TopBannerViewComposer
{
    private $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    public function compose($view)
    {
        $banners = $this->banner
            ->whereStatus(1)
            ->where('type', 'top')
            ->where('published_at', '<=', Carbon::now())
            ->Orderby('published_at', 'DESC')
            ->limit(5)
            ->get();

        $banner = $banners->random();
        
        return $view
            ->with('banner', $banner);
    }
}