<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = [
            ['title' => 'Not Finished', 'singer' => 'Lil Baby'],
            ['title' => 'Alone', 'singer' => 'Burna Boy'],
            ['title' => 'God Turned It Around', 'singer' => 'John Reddick'],
            ['title' => 'Park Chinios', 'singer' => 'Ktrap'],
            ['title' => 'Kingdom', 'singer' => 'Maverick City'],
        ];

        foreach ($songs as $song) {
            DB::table('songs')->insert($song);
        }
    }
}
