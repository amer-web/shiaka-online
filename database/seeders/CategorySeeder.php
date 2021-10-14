<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $root = Category::create([
            'position' => 0,
            'ar' => [
                'name' => 'قسم رئيسي',
                'description' => 'قسم رئيسي',
            ],
            'en' => [
                'name' => 'root',
                'description' => 'root',
            ],
        ]);
        $categories = [
            ['ar' => 'ملابس', 'en' => 'Clothes'],
            ['ar' => 'احذية', 'en' => 'Shoes'],
            ['ar' => 'شنط', 'en' => 'Bags'],
            ['ar' => 'اكسسوارات', 'en' => 'Accessories'],
            ['ar' => 'مفروشات', 'en' => 'Furniture'],
            ['ar' => 'ادوات منزلية', 'en' => 'HouseWare'],
        ];
        foreach ($categories as $key => $categoryCreate) {
            $category = Category::create([
                'position' => $key +1,

                'ar' => [
                    'name' => $categoryCreate['ar'],
                    'description' => $categoryCreate['ar'],
                ],
                'en' => [
                    'name' => $categoryCreate['en'],
                    'description' => $categoryCreate['en'],
                ],
            ]);
            $root->appendNode($category);
        }


    }
}
