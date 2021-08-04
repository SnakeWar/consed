<?php

namespace App\Feed;

use Spatie\Feed\FeedItem;

class EnhancedFeedItem extends FeedItem
{
    /** @var string */
    protected $mediaContent;

    protected $price;

    public function mediaContent(string $mediaContent)
    {
        $this->mediaContent = $mediaContent;

        return $this;
    }

    public function price($price) {
        $this->price = \money_format('%.2n', $price);
        return $this;
    }

}
