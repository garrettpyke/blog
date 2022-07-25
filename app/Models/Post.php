<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; //*GTK: by convention, Laravel looks for Database\Factories\PostFactory - php artisan make:factory PostFactory

    //protected $fillable = ['category_id', 'slug', 'title', 'excerpt', 'body']; // This attribute allows inserting all specified fields with one Eloquent operation. //! Protects against mass assignment vulnerability

    // protected $guarded = ['id'] Does the opposite of fillable. Everything else will be fillable. //*I prefer the fillable option.
    protected $guarded = [];


    //protected $with = ['category', 'author'];  //TODO we can now eliminate the 'load' statements from routes; this eager-loads by default

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
