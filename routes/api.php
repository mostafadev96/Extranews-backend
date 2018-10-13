<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/uploadphoto','PostController@addPhoto');

Route::group(['prefix' => 'post'],function(){
    Route::get('/latest/{tableid}','PostController@getLatestPosts');
    Route::get('/top/{tableid}','PostController@getTopPosts');
    Route::get('/{id}','PostController@getPost');
    Route::get('/portion/{tableid}','PostController@getPostsPortion');
    Route::post('/','PostController@createPost');
    Route::post('/visits','PostController@addVisit');
});
Route::group(['prefix' => 'video'],function(){
    Route::get('/latest','VideoPostController@getLatestVideos');
});
Route::group(['prefix' => 'album'],function(){
    Route::get('/latest','AlbumController@getLatestAlbum');
});

Route::group(['prefix' => 'general'],function(){
    Route::get('/latest','HomeController@getGeneralLatestPosts');
    Route::get('/top','HomeController@getGeneralTopPosts');
    Route::get('/slider','HomeController@getSliderPosts');
});
Route::post('/user','UserController@createAuthor');