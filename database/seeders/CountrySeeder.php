<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        $countries = json_decode(file_get_contents(public_path('temp/countries.json')), true);
        DB::table('countries')->insert($countries);

        DB::table('states')->delete();
        $states = json_decode(file_get_contents(public_path('temp/states.json')), true);
        DB::table('states')->insert($states);




    }
}
