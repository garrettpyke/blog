<?php

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
    return view('posts');
});

///* Method 1, baby steps ///
// Route::get('post', function () {
//     return view('post', [ //? (Allows key-value pairs)      
//         'post' => '<h1>Hello World!</h1>' // @param $post
//     ]);
// });

///* Method 2, still hard-coded ///
// Route::get('post', function () {
//     return view('post', [             
//         'post' => file_get_contents(__DIR__ . '/../resources/posts/my-first-post.html')
//     ]);  
// });

///* Wildcard variable - posts/test-post URL will return HTML with a 'test-post' body
// Route::get('posts/{post}', function ($slug) { //? {} is wildcard 
//     return $slug;
// });

///* Method 3 - putting the wildcard to use
// Route::get('posts/{post}', function ($slug) { 
//     $post = file_get_contents(__DIR__ . "/../resources/posts/{$slug}.html"); //? note: double-quotes needed here for variable
    
//     return view('post', [ 
//         'post' => $post
//     ]);  
// });

Route::get('posts/{post}', function ($slug) { 
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if (! file_exists($path)) {
        //ddd('file does not exist'); //? ddd: dump, die & debug; dd: dump & die
        //abort(404); //? throws HTTP error code
        return redirect('/');
    }

    $post = file_get_contents($path); 
    
    return view('post', [ 
        'post' => $post
    ]);  
})->where('post', '[A-z_\-]+'); //? ->where enables Regex parameters (+ helper functions) to limit what URLs can be entered
    //? helper functions are ->whereAlpha('post'), whereNumber, ...

