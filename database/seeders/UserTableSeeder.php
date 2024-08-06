<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(5)->create();

        $json = File::get("database/data/users.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            User::create([
                'name' => $obj->name,
                'email' => $obj->email,
                'admin' => $obj->admin,
                'password' => Hash::make($obj->password)
            ]);
        }
    }
}
