<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'amer',
            'last_name' => 'taha',
            'username' => 'amer_taha',
            'email' => 'amer@gmail.com',
            'password' => bcrypt('12345678'),
            'mobile' => '01112795101',
        ]);
        User::create([
            'first_name' => 'lolo',
            'last_name' => 'sayed',
            'username' => 'lolo_sayed',
            'email' => 'lolo@gmail.com',
            'password' => bcrypt('12345678'),
            'mobile' => '01111677669',
        ]);
    }
}
