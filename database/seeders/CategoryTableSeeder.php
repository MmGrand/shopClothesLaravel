<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(5)->create();

        $json = File::get("database/data/categories.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            Category::create([
                'name' => $obj->name,
                'slug' => $obj->slug,
                'content' => $obj->content,
                'image' => $obj->image,
                'parent_id' => $obj->parent_id
            ]);
        }
    }
}
