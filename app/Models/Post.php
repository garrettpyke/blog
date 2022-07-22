<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug) 
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body; 
        $this->slug = $slug;
    }

    public static function all()
    // Returns all posts
    {
        ///* YAML metadata parser! ///
        // $doc = YamlFrontMatter::parseFile(
        //     resource_path('posts/my-fourth-post.html')
        // );
        // ddd($doc->matter()); // * YAML - all metadata
        //ddd($doc->matter('title'));
        //ddd($doc->title); //? cool shortcut
 
        ///* Method 3: using Laravel Collections ///
        return cache()->rememberForever('posts.all', function() {
            $files = File::files(resource_path("posts"));

            return collect($files)
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
                })
                ->sortByDesc('date');
            });
    }

    public static function find($slug)
    // Of all blog posts, find the one with a slug that matches the one requested.
    {
        //$posts = static::all();

        $post = static::all()->firstWhere('slug', $slug);

        return $post;

        //?GTN cache for 20 min to avoid calling function (and accessing the filesystem for every HTTP GET. 
        //return cache()->remember("posts.{$slug}", 1200, function () use ($path) {
        //         return file_get_contents($path);
        //     });
    }

    public static function findOrFail($slug)
    // For cases when we want to throw an exception if post not found
    {
        $post = static::find($slug);

        if (! $post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}
