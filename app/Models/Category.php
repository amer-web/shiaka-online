<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;


class Category extends Model implements TranslatableContract
{
    use Translatable, NodeTrait;
    protected $guarded = [];

    public $Filledimages = ['photo'];
    public $translatedAttributes = ['name', 'slug', 'description'];

<<<<<<< HEAD
    public function products()
    {
        return $this->hasOne(Product::class);
    }
=======
    
>>>>>>> 4cc0fdf4963698c3b557caa4c42c821eda32f0d2
}
