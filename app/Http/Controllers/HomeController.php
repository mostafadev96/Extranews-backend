<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends ApiController
{
    public function getGeneralLatestPosts(){
        $latest = Post::orderBy('created_at', 'desc')
            ->with(['album','video','user','album.photos'])
            ->take(4)
            ->get();
        return $latest;
    }
    public function getGeneralTopPosts(){
        $top = Post::orderBy('visits', 'desc')
            ->with(['album','video','user','album.photos'])
            ->take(4)
            ->get();
        return $top;
    }
    public function getSliderPosts(){
        $posts=array();
        $post=Post::where('spec_type','=','sports')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        array_push($posts,$post);
        $post=Post::where('spec_type','=','life')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        array_push($posts,$post);
        $post=Post::where('spec_type','=','money')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        array_push($posts,$post);
        $post=Post::where('spec_type','=','tech')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        array_push($posts,$post);
        $post=Post::where('spec_type','=','travel')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        array_push($posts,$post);
        $post=Post::where('spec_type','=','style')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        array_push($posts,$post);
        $post=Post::where('spec_type','=','watcher')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        array_push($posts,$post);
        $post=Post::where('spec_type','=','health')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        array_push($posts,$post);
        $post=Post::where('spec_type','=','job')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        array_push($posts,$post);
        $post=Post::where('spec_type','=','network')
            ->with(['album','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
        array_push($posts,$post);
        return $posts;
    }

}
