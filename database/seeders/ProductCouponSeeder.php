<?php

namespace Database\Seeders;

use App\Models\ProductCoupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCoupon::create([
            'code' => 'Amer2021',
            'type' => 'fixed',
            'value' => 100,
            'description' => 'discount 100 EGP',
            'start_date' => Carbon::now(),
            'use_times' => 5,
            'expire_date' => Carbon::now()->addMonth(),
            'greater_than' => 600,
            'status' => true,
        ]);
        ProductCoupon::create([
            'code' => 'Lolo2021',
            'type' => 'percentage',
            'value' => 40,
            'description' => 'discount 40%',
            'use_times' => 10,
            'start_date' => Carbon::now(),
            'expire_date' => Carbon::now()->addWeek(),
            'greater_than' => null,
            'status' => true,
        ]);
    }
}
