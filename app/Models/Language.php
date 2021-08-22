<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Torann\Currency\Currency;

class Language extends Model
{
    protected $guarded = [];
    protected $statusLabel = [
        0 => 'غير مفعل',
        1 => 'مفعل'
    ];
    protected $directionLabel = [
        'rtl' => 'من اليمن إلى الشمال',
        'ltr' => 'من الشمال إلى اليمن'
    ];

    protected $curr = 15;

    public function getStatus()
    {
        return $this->statusLabel[$this->status];
    }
    public function getDirection()
    {
        return $this->directionLabel[$this->direction];
    }
    public function scopeActivation($q)
    {
        $q->where('status',1);
    }



}
