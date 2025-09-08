<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class LastFmController extends Controller
{
    public function getTopTracks()
    {
        $apiKey = env('LASTFM_API_KEY');

        $response = Http::get('https://ws.audioscrobbler.com/2.0/', [
            'method' => 'chart.gettoptracks',
            'api_key' => $apiKey,
            'format' => 'json',
        ]);

        $tracks = $response->json()['tracks']['track'];

        // Verwerk de resultaten, bijvoorbeeld opslaan in de database of doorsturen naar een view.
        return view('lastfm.toptracks', ['tracks' => $tracks]);
    }
}
