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

    public function status()
    {
        return $this->status ? 'مفعل' : 'غير مفعل';
    }

    public function getAllProducts()
    {
        return Category::withCount('products')->descendantsAndSelf($this->id)->sum('products_count');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
