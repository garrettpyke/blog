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

//*GTN: this method uses Route-Model binding. Laravel matches name of argument with route. (Must be same name for this to work)
Route::get('posts/{post}', function (Post $post) { 
        
        return view('post', [
            'post' => $post
        ]);
    
    });