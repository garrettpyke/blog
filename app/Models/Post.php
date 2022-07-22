<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'excerpt', 'body']; // This attribute allows inserting all specified fields with one Eloquent operation. //! Protects against mass assignment vulnerability

    // protected $guarded = ['id'] Does the opposite of fillable. Everything else will be fillable

}
