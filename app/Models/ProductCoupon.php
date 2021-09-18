<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCoupon extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getStartDateAttribute($value)
    {
        return date_create($value)->format('Y-m-d');

    }
    public function getExpireDateAttribute($value)
    {
        return date_create($value)->format('Y-m-d');

    }

}
