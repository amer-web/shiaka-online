<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function states()
    {
        return $this->hasMany(State::class);
    }


    public function shipping_companies()
    {
        return $this->belongsToMany(ShippingCompany::class,'shipping_company_country');
    }
}
