<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BandSeeder;
use Database\Seeders\AlbumSeeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BandSeeder::class);
        $this->call(AlbumSeeder::class);

        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
