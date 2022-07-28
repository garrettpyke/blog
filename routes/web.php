<?php

use App\Http\Controllers\PostsController;
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

Route::get('/', [PostsController::class, 'index'])->name('home');
//*GTK: This is a named route

Route::get('posts/{post:slug}', [PostsController::class, 'show']);
 
Route::get('authors/{author:user_name}', function (User $author) {

    // dd($author); //*GTK: attributes element shows all contents of variable

    return view('posts', [
        'posts' => $author->posts,
        'categories' => Category::all(),
    ]);
});