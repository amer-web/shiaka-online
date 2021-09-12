<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ProductCouponSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(ShippingCompanySeeder::class);
    }
}
