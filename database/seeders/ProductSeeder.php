<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        DB::table('media')->delete();
        $faker = Factory::create();
        $fakerAr = Factory::create('ar_SA');
        $categories = Category::whereNotNull('parent_id')->pluck('id');

        for ($i = 1; $i <= 100; $i++) {
            $product = [
                'ar' => [
                    'name' => $fakerAr->name,
                    'description' => $fakerAr->name . ' ' . $fakerAr->name . ' ' . $fakerAr->name,
                ],
                'en' => [
                    'name' => $faker->name,
                    'description' => $faker->text,
                ],
                'price' => $faker->numberBetween(100, 500),
                'quantity' => $faker->numberBetween(1, 25),
                'category_id' => $categories->random(),
                'featured' => rand(0, 1),
                'status' => rand(0, 1),
            ];
            $product = Product::create($product);
            $path = public_path('images\products\\' . $product->id);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            for ($i = 1; $i <= rand(1, 3); $i++) {
                $imageName = $faker->image($path, 488, 488, $product->slug, false);
                $product->media()->create(['file_name' => 'images/products/' . $product->id . '/' . $imageName]);
                $i++;
            }
        }
    }
}
