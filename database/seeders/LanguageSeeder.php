<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'abbr' => 'ar',
            'name' => 'العربية',
            'status' => 1,
            'direction' => 'rtl',
        ]);
        Language::create([
            'abbr' => 'en',
            'name' => 'English',
            'status' => 1,
            'direction' => 'ltr',
        ]);
    }


}
