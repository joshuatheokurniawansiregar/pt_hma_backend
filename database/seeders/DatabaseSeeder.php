<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'user_email' => 'Test User',
            'user_password' => 'test@example.com',
            'user_fullname' => 'Joshua Theo',
            'use_role' => 'master_user'
        ]);

        
    }
}
