<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product::factory(20)->create();

        $json = File::get("database/data/products.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            Product::create([
                'name' => $obj->name,
                'slug' => $obj->slug,
                'content' => $obj->content,
                'image' => $obj->image,
                'price' => $obj->price,
                'sale' => $obj->sale,
                'hit' => $obj->hit,
                'new' => $obj->new,
                'is_published' => $obj->is_published,
                'views_count' => $obj->views_count,
                'category_id' => $obj->category_id,
                'brand_id' => $obj->brand_id
            ]);
        }
    }
}
