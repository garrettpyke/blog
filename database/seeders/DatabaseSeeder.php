<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use \App\Models\User;
use \App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //* Create 10 users
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //* truncate will prevent duplication error for unique fields (Category name & slug)
        User::truncate();
        Category::truncate();

        $user = User::factory()->create();

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobbies'
        ]);

        Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);
    }
}
