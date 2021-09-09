<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();
        $cities = json_decode(file_get_contents(public_path('temp/cities.json')), true);
        $cities = collect($cities);
        $cities = $cities->chunk(500);
        foreach ($cities as $city) {
            DB::table('cities')->insert($city->toArray());
        }
        $countriesArray = ['Algeria', 'Bahrain', 'Djibouti', 'Egypt', 'Iraq', 'Jordan', 'Kuwait', 'Lebanon', 'Libya', 'Morocco', 'Mauritania', 'Oman', 'Palestinian Territory Occupied', 'Qatar', 'Saudi Arabia', 'Sudan', 'Syria', 'Tunisia', 'Yemen'];
        Country::whereHas('states')->whereIN('name',$countriesArray)->update(['status' => 1]);

        State::whereHas('cities')->whereHas('country',function($q){
            $q->where('status',1);
        })->update(['status' => 1]);

        City::whereHas('state',function($q){
            $q->where('status',1);
        })->update(['status' => 1]);
    }
}
