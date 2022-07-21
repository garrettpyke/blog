<?php

namespace App\Models;

class Post
{
    public static function find($slug)
    {
        //base_path(); //? helper function to return base dir of project, app, resource, ...
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            return redirect('/');
        }

        // cache for 20 min to avoid calling function (and accessing the filesystem for every HTTP GET. 
       return cache()->remember("posts.{$slug}", 1200, function () use ($path) {
            return file_get_contents($path);
        });
    }
}
