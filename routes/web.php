<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::get('/', function () {
    $posts = Post::all();

    return view('posts', [
        'posts' => $posts
    ]);

});

Route::get('posts/{post}', function ($id) { 
// Find a post by its slug and pass it to a view called "post"

    $post = Post::find($id);
    
    return view('post', [
        'post' => $post
    ]);

});