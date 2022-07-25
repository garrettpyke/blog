<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use \App\Models\User;
use \App\Models\Category;
use \App\Models\Post;
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
        //* Create 10 users (no argument will create 1)
        // \App\Models\User::factory(10)->create();

        //* truncate will prevent duplication error for unique fields when not seeding fresh (Category name & slug) 
        //* Running `..migrate:fresh --seed` will eliminate the need for this as tables are dropped 
        User::truncate();
        Category::truncate();
        Post::truncate();

        // Create fake data for everything but the following
        $user = User::factory()->create([
            'name' => 'Rusty Shackleford'
        ]);

        // ...and associate that user with all posts
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);
    }
}
