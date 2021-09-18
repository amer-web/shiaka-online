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

    
}
