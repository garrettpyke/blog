<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;

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
    //$posts = Post::all();

    // ddd($posts); //? Dumps the variable, showing it's an array
    // ddd($posts[0]);
    // ddd($posts[0]->getPathname()); //? good to know array method
    // ddd((string)$posts[0]); //? gtn
    // ddd($posts[0]->getContents()); //? gtn

     ///* YAML metadata parser! ///
    // $doc = YamlFrontMatter::parseFile(
    //     resource_path('posts/my-fourth-post.html')
    // );
    // ddd($doc->matter()); // * YAML - all metadata
    //ddd($doc->matter('title'));
    //ddd($doc->title); //? cool shortcut


    $files = File::files(resource_path("posts"));
 
     ///* Method 3: using Laravel Collections ///
    $posts = collect($files)
        ->map(function ($file) {
            return YamlFrontMatter::parseFile($file);
        })
        ->map(function ($document) {    
            return new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug 
            );             
        });

    ///* Method 2: mapping the array ///
    // $posts = array_map(function ($file) {
    //     $document = YamlFrontMatter::parseFile($file);

    //     return new Post(
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug 
    //     ); 
    // }, $files);

    ///* Method 1: foreach ///
    // $posts = [];
    // foreach ($files as $file) {
    //     $document = YamlFrontMatter::parseFile($file);

    //     $posts[] = new Post(
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug 
    //     );
    // }
   
    return view('posts', [
        'posts' => $posts
    ]);

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

//* Method 4 - using wildcard to load the correct URL path
// Route::get('posts/{post}', function ($slug) { 
//     $path = __DIR__ . "/../resources/posts/{$slug}.html";

//     if (! file_exists($path)) {
         //ddd('file does not exist'); //? ddd: dump, die & debug; dd: dump & die
         //abort(404); //? throws HTTP error code
//         return redirect('/');
//     }

//     //* cache for 5 seconds to avoid calling function (and accessing the filesystem for every HTTP GET. Shorthand for long times is member function now->addDays()), Weeks, Minutes, etc
//     $post = cache()->remember("posts.{$slug}", 5, function () use ($path) { //? 'use' keyword allows access to path variable inside the function
         //var_dump('file_get_contents'); // will show when file_get_contents is actually called vs. using the cache
//         return file_get_contents($path); 
//     });

//         return view('post', [ 
//         'post' => $post
//     ]);  
// })->where('post', '[A-z_\-]+'); //? ->where enables Regex parameters (+ helper functions) to limit what URLs can be entered
//     //? helper functions are ->whereAlpha('post'), whereNumber, ...

Route::get('posts/{post}', function ($slug) { 
// Find a post by its slug and pass it to a view called "post"

    //return Post::find('my-first-post'); //* Just testing the Post.find method

    $post = Post::find($slug);
    
    return view('post', [
        'post' => $post
    ]);

})->where('post', '[A-z_\-]+'); 