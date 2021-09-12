<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function fast()
    {
        return  $this->fast ? 'نعم' : 'لا';
    }
    public function status()
    {
        return $this->status ? 'مفعل' : 'غير مفعل' ;
    }
    public function countries()
    {
        return $this->belongsToMany(Country::class,'shipping_company_country');
    }

}
