<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteLogoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'logo_file_path' => 'storage/logo_hma.png',
            'logo_file_name' => 'logo_hma.png',
            'logo_file_link' => 'http://127.0.0.1:8000/storage/logo_hma.png',
        ]);
    }
}
