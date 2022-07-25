<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
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

    //*GTK: handy helper function to see DB activity (see storage/logs/laravel.log)
    // \Illuminate\Support\Facades\DB::listen(function ($query) {
    //     logger($query->sql, $query->bindings);
    // });

    //*GTK: 'with' function = Eager loading - Here it resolves n+1 problem (see comment in posts view) and improves performance 
    //*GTK: 'latest' adds an sql ORDER BY 
    $posts = Post::latest()->with('category', 'author')->get();

    return view('posts', [
        'posts' => $posts
    ]);
});

//*GTK: this method uses Route-Model binding. Laravel matches name of argument with route. (Must be same name for this to work)
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

// No slug needed here. 
Route::get('authors/{author:user_name}', function (User $author) {

    // dd($author); //*GTK: attributes element shows all contents of variable

    return view('posts', [
        'posts' => $author->posts
    ]);
});