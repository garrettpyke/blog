<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // allows when method for conditional querying - apply the callback's query changes if the given "value" is true (see scopeQuery function)

class Post extends Model
{
    use HasFactory; //*GTK: by convention, Laravel looks for Database\Factories\PostFactory - php artisan make:factory PostFactory

    protected $guarded = [];


    protected $with = ['category', 'author'];  //* to eliminate the 'load' statements from routes, this eager-loads by default. (Do only when relationship is needed)

    //* This is a Dedicated Query-scope - used to isolate messier queries
    public function scopeFilter($query, array $filters) // Post::newQuery()->filter() - omit scope when calling
    {
        //TODO ?? is PHP8 null-safe operator
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%'));

        //*GTK: This query allows http://127.0.0.1:8000/?category=ut-tenetur-id-provident-fugit-non-cupiditate-facere
        //* ...and http://127.0.0.1:8000/?search=qui&category=omnis
        $query->when($filters['category'] ?? false, fn ($query, $category) =>
            $query->whereHas('category', fn ($query) => 
                $query->where('slug', $category)
            )
        );

            // $query    
                // ->whereExists(fn($query) => 
                //     $query->from('categories')
                //         ->whereColumn('categories.id', 'posts.category_id')
                //         //* whereColumn because category_id is not a string!
                //         ->where('categories.slug', $category))
            // );
    }

    ///* RELATIONSHIP is defined here ///
    public function category() //*GTK: Laravel assumes foreign key of category_id
    {
        // Relationship types - hasOne, hasMany, belongsTo, belongsToMany

        return $this->belongsTo(Category::class);
        // $post->category will be magically returned thru Eloquent (as if category were a property)
    }

    //*GTK Rename from user() to author to improve developer-app relations :) 
    //*...need optional 2nd argument for DB field name 
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
