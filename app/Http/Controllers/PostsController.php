<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        // die('hello'); // making sure I'm hitting this controller action
        // dd(request(['search'])); the brackets around the search string force an array

        return view('posts', [
            // get() means execute query - implies query is completely built
            //* filter is calling the dedicated query scope inPost model

                        // this is what is passed to the query scope (2nd argument in Post->scopeFilter)
            'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
            // 'categories' => Category::all(), //* Now handled by the CategoryDropdown view
            // 'currentCategory' => Category::firstWhere('slug', request('category')) //* Now handled by the CategoryDropdown view
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }
}
