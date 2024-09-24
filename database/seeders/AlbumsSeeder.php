<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Album;



class AlbumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Voorbeeld van enkele albums met bijbehorende band_id's
        $albums = [
            ['name' => 'IV', 'year' => 1971, 'times_sold' => 37, 'band_id' => 2], // Led Zeppelin
            ['name' => 'Abbey Road', 'year' => 1969, 'times_sold' => 32, 'band_id' => 3], // The Beatles
            ['name' => 'The Dark Side of the Moon', 'year' => 1973, 'times_sold' => 45, 'band_id' => 4], // Pink Floyd
            // Voeg hier meer albums toe indien gewenst
        ];

        // Maak albums aan in de database
        foreach ($albums as $album) {
            Album::create($album);
        }
    }
}
