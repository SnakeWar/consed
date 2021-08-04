<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function getEmbed($url = null)
    {
        if (preg_match('/vimeo\.com\/[^0-9]*([0-9]+)(?:|\/\?)/', $url ? $url : $this->src, $matches)) {
            if (count($matches) > 1) {
                return 'https://player.vimeo.com/video/' . $matches[1] . '?title=0&byline=0&portrait=0';
            }
        }

        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url ? $url : $this->src, $matches)) {
            if (count($matches) > 1) {
                return 'https://www.youtube.com/embed/' . $matches[1] . '?rel=0&amp;showinfo=0';
            }
        }

        return $this->src;
    }

    public function getThumb($url = null)
    {
        if (preg_match('/vimeo\.com\/[^0-9]*([0-9]+)(?:|\/\?)/', $url ? $url : $this->src, $matches)) {
            if (count($matches) > 1) {
                $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$matches[1].php"));

                return $hash[0]['thumbnail_large'];
            }
        }

        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url ? $url : $this->src, $matches)) {
            if (count($matches) > 1) {
                return 'https://i.ytimg.com/vi/' . $matches[1] . '/hqdefault.jpg';
            }
        }

        return false;
    }

    public function getYoutubeVideos($results, $type= ['none', 'live', 'upcoming']) {
        try {
            $key = 'AIzaSyCd33rS7Q19QyrhUOEq_8ZdkBSDTDZl0as';
            $channel = 'UCPvUFqjcgSQ_CIiZn_DqQMQ';

            $ch = curl_init('https://www.googleapis.com/youtube/v3/search?key=' . $key . '&channelId=' . $channel . '&part=snippet,id&order=date&maxResults=' . $results);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
            $response = json_decode(curl_exec($ch), true);
            curl_close($ch);

            $return = [];

            foreach ($response['items'] as $video) {
                if(in_array($video['snippet']['liveBroadcastContent'], $type)) {
                    array_push($return, [
                        'src' => 'http://www.youtube.com/watch?v=' . $video['id']['videoId'],
                        'title' => $video['snippet']['title'],
                        'thumb' => $video['snippet']['thumbnails']['high']['url'],
                        'created_at' => $video['snippet']['publishedAt']
                    ]);
                }
            }

            return $return;
        } catch (\Exception $e) {
            return false;
        }
    }
}
