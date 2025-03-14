<?php

namespace Database\Seeders;

use App\Models\Contentes;
use App\Models\Courses;
use App\Models\Traks;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Traks::factory(2)->create();
        Courses::factory(20)->create();
        Contentes::factory(40)->create();
    }
}
