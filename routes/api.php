<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// me
Route::get('me/course','Api\ProfileController@course');
Route::get('me/blog','Api\ProfileController@blog');

Route::get('blog','Api\BlogController@index');
Route::get('course','Api\CourseController@index');
Route::get('course/category/{id}','Api\CourseController@category');
Route::get('course/{id}/{slug}','Api\CourseController@view');
Route::get('blog/{id}','Api\BlogController@view');
Route::get('forum','Api\ForumController@index');
Route::post('forum/del-cmt','Api\ForumController@delete');
Route::get('forum/category','Api\ForumController@cate');
Route::post('forum/add','Api\ForumController@add');
Route::post('forum/reply','Api\ForumController@reply');
Route::get('forum/{id}/{slug}','Api\ForumController@view');
Route::get('document','Api\DocumentController@index');



// upload file
Route::post('forum/upload','Api\ForumController@upload');