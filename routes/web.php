<?php

use App\Models\Post;
use App\Models\Category;
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

    //*GTN: handy helper function to see DB activity (see storage/logs/laravel.log)
    // \Illuminate\Support\Facades\DB::listen(function ($query) {
    //     logger($query->sql, $query->bindings);
    // });

    //*GTN: 'with' function resolves n+1 problem (see comment in posts view) and improves performance
    $posts = Post::with('category')->get();

    return view('posts', [
        'posts' => $posts
    ]);
});

//*GTN: this method uses Route-Model binding. Laravel matches name of argument with route. (Must be same name for this to work)
Route::get('posts/{post:slug}', function (Post $post) { //behind the scenes looks like Post::where('slug', $post)->firstOrFail();

    return view('post', [
        'post' => $post
    ]);
});

Route::get('categories/{category:slug}', function (Category $category) {

    return view('posts', [
        'posts' => $category->posts
    ]);
});