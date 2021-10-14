<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class Product extends Model implements TranslatableContract,LocalizedUrlRoutable
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'slug', 'description'];
    public $guarded = [];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getLocalizedRouteKey($locale)
    {
        $tran = $this->translations()->where('locale',$locale)->first();
        return $tran->slug;
    }
//
    public function resolveRouteBinding($slug, $field = NULL)
    {
        return static::whereHas('translations', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })->first() ?? abort('404');
    }
//    function translateRoute($locale){
//
//        //Get the path type
//        //http://www.example.com/en/hotels -> get hotels
//        $req = \URL::getRequest();
//        $type = urldecode($req->segment(2));
//
//        //Get the route translated for current locale
//        $hotels = Lang::get('admin.product');
//
//        if(mb_strtolower($type) == mb_strtolower($this)){
//            //Get the localized route
//            $hotelsLocalized = Lang::get('admin.product', [], $locale);
//            //Make the magic with urlencode php function ;)
//            return url(LaravelLocalization::getLocalizedURL($locale, urlencode($hotelsLocalized)));
//        }
//        //IF not hotel return normal translated route
//        return urldecode(LaravelLocalization::getLocalizedURL($locale));
//    }

//    public static function transRoute($locale)
//    {
//        $route = Lang::get('admin', [], 'en');;
//        $req = \URL::getRequest();
//        $type = urldecode($req->segment(2));
//        if(in_array($type, array_keys($route) )){
//            return url(LaravelLocalization::getLocalizedURL($locale, urldecode($route[$type])));
//        }
//        return urldecode(LaravelLocalization::getLocalizedURL($locale));
//    }
    public function currencyPrice()
    {
        return currency($this->price);
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class)->where('status',1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public  function scopeCategoriesBySlug($query,$slug)
    {
        $parentCategory = Category::whereHas('translations' , function($q)use ($slug){
            $q->where('slug',$slug);
        })->select('id')->first();
        $descendants =  Category::descendantsAndSelf($parentCategory->id)->pluck('id');
       return $query->with('translations')->whereIn('category_id',$descendants);
    }

    public function ancestorsProduct()
    {
        return Category::whereNotNull('parent_id')->with('translations')->ancestorsAndSelf($this->category->id);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function featured()
    {
        return $this->featured ? 'نعم' : false;
    }

    public function status()
    {
        return $this->status ? 'مفعل' : 'غير مفعل';
    }

    public function get_image()
    {
        return $this->media->first()->file_name ?? '';
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_product');
    }
}
