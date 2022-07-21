<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    public static function all()
    // Returns all posts
    {
        $files = File::files(resource_path("posts/"));
        // return $files; //? This will simply stringify the file paths, which we don't want

        return array_map(function ($file) {
            return $file->getContents();
        }, $files);  
    }

    public static function find($slug)
    // Returns a single post
    {
        //base_path(); //? helper function to return base dir of project, app, resource, ...
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }

        // cache for 20 min to avoid calling function (and accessing the filesystem for every HTTP GET. 
       return cache()->remember("posts.{$slug}", 1200, function () use ($path) {
            return file_get_contents($path);
        });
    }
}
