<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Brand::factory(5)->create();

        $json = File::get("database/data/brands.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            Brand::create([
                'name' => $obj->name,
                'slug' => $obj->slug,
                'content' => $obj->content,
                'image' => $obj->image
            ]);
        }
    }
}
