<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
use Illuminate\Http\Request;

class AlbumController extends ApiController
{
    public function createAlbum(Request $request){

        $album=new Album;
        $album->title=$request->title;
        $album->save();
        foreach ($request['album']['photos'] as $photo) {
            $gallery=new Gallery;
            $gallery->album_id=$album->id;
            $gallery->photo=$photo;
            $gallery->save();
        }
        return $album;
    }
    public function getLatestAlbum(){
        $latest = Album::orderBy('created_at', 'desc')
            ->whereNotNull('title')
            ->with(['photos','post'])
            ->take(1)
            ->get();
        return $latest;
    }
}
