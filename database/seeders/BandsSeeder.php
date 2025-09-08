<?php

namespace Database\Seeders;

use App\Models\Band;
use Illuminate\Database\Seeder;

class BandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Voorbeeld van enkele bands
        $bands = [
            ['name' => 'Led Zeppelin', 'genre' => 'Rock', 'founded' => 1968],
            ['name' => 'The Beatles', 'genre' => 'Rock', 'founded' => 1960],
            ['name' => 'Pink Floyd', 'genre' => 'Progressive Rock', 'founded' => 1965],
            // Voeg hier meer bands toe indien gewenst
        ];

        // Maak bands aan in de database
        foreach ($bands as $band) {
            Band::create($band);
        }
    }
}
