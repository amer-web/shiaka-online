<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->delete();
       DB::table('currencies')->insert([
          [
              'code' => 'EGP',
              'name' => 'Egyptian Pound',
              'symbol' => 'ج.م',
              'format' => 'ج.م 1,0.00',
              'exchange_rate' => 1.00,
              'active' => true
          ],
           [
               'code' => 'USD',
               'name' => 'US Dollar',
               'symbol' => '$',
               'format' => '$1,0.00',
               'exchange_rate' => 0.067,
               'active' => true
           ],
           [
               'code' => 'EUR',
               'name' => 'Euro',
               'symbol' => '€',
               'format' => '1.0,00 €',
               'exchange_rate' => 0.055,
               'active' => true
           ]
       ]);
    }
}
