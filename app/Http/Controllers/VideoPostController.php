<?php

namespace App\Http\Controllers;

use App\VideoPost;
use Illuminate\Http\Request;

class VideoPostController extends ApiController
{
    public function getLatestVideos(){
        $latest = VideoPost::orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        return $latest;
    }
}
