<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LastFmController extends Controller
{
    public function getTopTracks()
    {
        $apiKey = env('LASTFM_API_KEY');
<<<<<<< HEAD
        $response = Http::get(
            'https://ws.audioscrobbler.com/2.0/', [
            'method' => 'chart.gettoptracks',
            'api_key' => $apiKey,
            'format' => 'json',
            ]
        );

        $tracks = $response->json()['tracks']['track'];

        // Verwerk de resultaten, bijvoorbeeld opslaan in de database of doorsturen naar een view.
        return view('lastfm.toptracks', ['tracks' => $tracks]);
=======
$response = Http::get('https://ws.audioscrobbler.com/2.0/', [
    'method' => 'chart.gettoptracks',
    'api_key' => $apiKey,
    'format' => 'json',
]);

$tracks = $response->json()['tracks']['track'];

// Verwerk de resultaten, bijvoorbeeld opslaan in de database of doorsturen naar een view.
return view('lastfm.toptracks', ['tracks' => $tracks]);
>>>>>>> 50c894a86b61dccd84cf6a8ee60896140aee874b

    }
}
