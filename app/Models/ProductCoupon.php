<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ProductCoupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getStartDateAttribute($value)
    {
        return ($value) ? date_create($value)->format('Y-m-d') : '';

    }

    public function getExpireDateAttribute($value)
    {
        return ($value) ? date_create($value)->format('Y-m-d') : '';

    }

    public function discount($total)
    {
        if (!$this->checkDateExpire() || !$this->checkUsed_times()) {
            return 0;
        }

        return $total >= $this->greater_than ? $this->processes($total) : 0;
    }

    public function checkDateExpire()
    {
        return $this->expire_date != '' ? (Carbon::now()->between($this->start_date, $this->expire_date)) ? true : false : true;
    }

    public function checkUsed_times()
    {
        return $this->use_times != '' ? $this->use_times > $this->used_times : true;
    }

    public function processes($total)
    {
        switch ($this->type) {
            case 'fixed':
                return $this->value;
                break;
            case 'percentage':
                return $this->value / 100 * $total;
                break;
            default;
                return 0;
        }
    }
}
