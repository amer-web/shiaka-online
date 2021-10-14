<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    const NewOrder = 0;
    const PAYMENT_COMPLETED = 1;
    const UNDER_PROCESS = 2;
    const FINISHED = 3;
    const REJECTED = 4;
    const CANCELED = 5;
    const REFUNDED_REQUEST = 6;
    const Returned_Order = 7;
    const REFUNDED = 8;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipping_company()
    {
        return $this->belongsTo(ShippingCompany::class);
    }

    public function user_address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('qty');
    }

    public function transactions()
    {
        return $this->hasMany(OrderTransaction::class);
    }

    public function status($transaction = null)
    {
        $status = $transaction ?? $this->order_status;
        switch ($status) {
            case 0:
                $result = '<label class="badge badge-success">طلب جديد</label>';
                break;
            case 1:
                $result = '<label class="badge badge-primary">تم الدفع</label>';
                break;
            case 2:
                $result = '<label class="badge badge-info">تحت المعاينة</label>';
                break;
            case 3:
                $result = '<label class="badge badge-success">تم الانتهاء</label>';
                break;
            case 4:
                $result = '<label class="badge badge-warning">مرفوض</label>';
                break;
            case 5:
                $result = '<label class="badge bg-dark tx-white">تم الالغاء</label>';
                break;
            case 6:
                $result = '<label class="badge badge-dark">طلب استرجاع</label>';
                break;
            case 7:
                $result = '<label class="badge badge-success">قبول طلب الاسترجاع</label>';
                break;
            case 8:
                $result = '<label class="badge badge-info">تم استرجاع المبلغ</label>';
                break;
        }
        return $result;
    }

    public function paymentCurrencySymbol()
    {
        $currencies = currency()->getCurrencies();
        foreach ($currencies as $currency) {
            if ($currency['code'] == $this->payment_currency) {
                $result = $currency['symbol'];
            }
        }
        return $result;
    }
}
