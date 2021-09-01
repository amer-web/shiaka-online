<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin'
        ]);
        $customer = Role::create([
            'name' => 'customer',
            'display_name' => 'Customer'
        ]);
        $supervisor =  Role::create([
            'name' => 'supervisor',
            'display_name' => 'Supervisor'
        ]);
        User::find(1)->attachRole($admin);
        User::find(2)->attachRole($customer);
    }
}
