<?php

namespace Database\Seeders;

use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_companies')->delete();
        $sha1 = ShippingCompany::create([
            'name' => 'Aramex',
            'code' => 'Aramex-Normal',
            'description' => 'Aramex-Normal Shipping Normal',
            'fast' => false,
            'cost' => '150.00',
            'status' => true,
        ]);
        $sha1->countries()->attach([194]);
        $sha1 = ShippingCompany::create([
            'name' => 'Aramex',
            'code' => 'Aramex-Fast',
            'description' => 'Aramex-Fast Shipping Normal',
            'fast' => true,
            'cost' => '200.00',
            'status' => true,
        ]);
        $sha1->countries()->attach([194]);
    }
}
