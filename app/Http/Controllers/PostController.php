<?php

namespace App\Http\Controllers;

use App\Album;
use App\Gallery;
use App\Post;
use App\VideoPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends ApiController
{
    public function getLatestPosts($tableid){
        $latest = Post::where('type','=',$this->getTableName($tableid))
            ->with(['album','video','user','album.photos'])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        return $latest;
    }
    public function getTopPosts($tableid){
        $top = Post::where('type','=',$this->getTableName($tableid))
            ->with(['album','video','user','album.photos'])
            ->orderBy('visits', 'desc')
            ->take(4)
            ->get();
        return $top;
    }
    public function getPostsPortion($tableid){
        $portion = Post::where('type','=',$this->getTableName($tableid))->with(['album','video','user','album.photos'])->paginate(4,['*'],'posts');
        return $portion;
    }
    public function createPost(Request $request){
        $post=new Post;
        $post->title=$request->title;
        if($request->exists('description')){
        $post->description=$request->description;
        }
        $post->type=$request->type;
        $post->user_id=$request->author;
        $post->visits=0;
        $post->spec_type=$request->spec_type;
        if($request->exists('video')){
            $video=new VideoPost;
            $video->title=$request['video']['title'];
            $video->link=$request['video']['link'];
            $video->duration=$request['video']['duration'];
            $curl = curl_init();

            $pvars   = array('image' => $request['video']['photo']);
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID 16ece6b6a598502' ));
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
            $out = curl_exec($curl);
            curl_close ($curl);
            $pms = json_decode($out,true);
            $video->photo=$pms['data']['link'];
            $video->save();
            $post->video_id=$video->id;
        }
        if($request->exists('album')){
            $album=new Album;
            $album->title=$request->title;
            $album->save();
            foreach ($request['album']['photos'] as $photo) {
                $curl = curl_init();
                $pvars   = array('image' => $photo);
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID 16ece6b6a598502' ));
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
                $out = curl_exec($curl);
                curl_close ($curl);
                $pms = json_decode($out,true);
                $gallery=new Gallery;
                $gallery->album_id=$album->id;
                $gallery->photo=$pms['data']['link'];
                $gallery->save();
            }
            $post->album_id=$album->id;
        }
        $post->save();
        return $post;
    }
    public function addVisit(Request $request){

        $post=Post::find($request->id);
        if(!$post){
            return array(['found' => false,'post' => []]);
        }
        else{
            $post->increment('visits');
            return array(['found' => true,'post' => $post]);
        }
    }
    public function addPhoto(Request $request){
        if ($request->exists('photo')) {
            return array('image' => base64_encode($request->file('photo')));
        }
        return array('image' => 'No');
    }
    public function getPost($id){
        $top = Post::find($id)->with(['album','video','user','album.photos']);
        return $top;
    }

}
