<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();
        Post::factory(20)->create();
        Comment::factory(20)->create();
        Reply::factory(20)->create();

        // User::factory()->create([
            // 'name' => 'Test User',
            // 'email' => 'test@example.com',
        // ]);
    }
}
