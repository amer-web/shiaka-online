<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_reviews')->delete();
        $faker = Factory::create();
        Product::all()->each(function ($product) use ($faker) {
            for ($i = 1; $i < rand(1, 30); $i++) {
                $product->reviews()->create([
                    'comment' => $faker->paragraph,
                    'rating' => rand(1, 5),
                    'title' => $faker->title,
                    'name' => $faker->userName,
                    'status' => rand(0, 1),
                    'user_id' => rand(1, 2),
                ]);
            }
        });
    }
}
