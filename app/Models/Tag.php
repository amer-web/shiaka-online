<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $guarded = [];

//    public function categories()
//    {
//        return $this->morphedByMany(Category::class,'taggable');
//    }

    public function products()
    {
        return $this->morphedByMany(Product::class,'taggable');
    }
}
