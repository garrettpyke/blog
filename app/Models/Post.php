<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; //*GTN: by convention, Laravel looks for Database\Factories\PostFactory - php artisan make:factory PostFactory

    //protected $fillable = ['category_id', 'slug', 'title', 'excerpt', 'body']; // This attribute allows inserting all specified fields with one Eloquent operation. //! Protects against mass assignment vulnerability

    // protected $guarded = ['id'] Does the opposite of fillable. Everything else will be fillable. //*I prefer the fillable option.
    protected $guarded = [];

    ///* RELATIONSHIP is defined here ///
    public function category()
    {
        // Relationship types - hasOne, hasMany, belongsTo, belongsToMany

        return $this->belongsTo(Category::class);
        // $post->category will be magically returned thru Eloquent (as if category were a property)
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
