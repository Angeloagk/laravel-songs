<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Album;
use Illuminate\Support\Facades\Http;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::all(); // Haal alle songs op uit de database
        return view('songs.index', ['songs' => $songs]);
    }

    // SongController.php
    public function show($id)
    {
        $song = Song::find($id);
        return view('songs.show', ['song' => $song]);
    }

    public function create(Request $request)
    {
        // Stel de Last.fm API-sleutel in
        $api_key = '7defd3431098e35855dd39c3ceffe7d8';

        // Haal de titel op vanuit het verzoek (bijvoorbeeld /songs/create?title=whistler)
        $title = $request->input('title');

        // Roep de Last.fm API aan om nummers op te halen op basis van de opgegeven titel
        $response = Http::get(
            'https://ws.audioscrobbler.com/2.0/', [
            'method' => 'track.search',
            'api_key' => $api_key,
            'format' => 'json',
            'track' => $title,
            ]
        );

        // Controleer of de 'results' sleutel aanwezig is in de JSON-reactie
        $responseData = $response->json();
        if (isset($responseData['results']['trackmatches']['track'])) {
            // Haal de nummers op uit de API-respons
            $songsFromAPI = $responseData['results']['trackmatches']['track'];
        } else {
            // Geef een lege array door als 'results' sleutel ontbreekt of leeg is
            $songsFromAPI = [];
        }

        // Geef de $songsFromAPI door aan de create view
        return view('songs.create', ['songsFromAPI' => $songsFromAPI]);
    }


    public function destroy($id)
    {
        $song = Song::find($id);

        if (!$song) {
            return redirect()->route('songs.index')->with('error', 'Song not found.');
        }

        $song->delete();

        return redirect()->route('songs.index')->with('success', 'Song has been deleted successfully.');
    }

    public function edit($id)
    {
        $song = Song::find($id);
        $albums = Album::all();

        return view('songs.edit', compact('id', 'song', 'albums'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate(
            [
            'title' => 'required|string|max:255',
            'singer' => 'required|string|max:255',
            // Voeg andere validatieregels toe indien nodig
            ]
        );

        $song = Song::find($id);

        if (!$song) {
            return redirect()->route('songs.index')->with('error', 'Song not found.');
        }

        // Update het liedje met de gevalideerde gegevens
        $song->update(
            [
            'title' => $request->input('title'),
            'singer' => $request->input('singer'),
            ]
        );

        // Voeg de geselecteerde albums toe aan het lied
        if ($request->has('albums')) {
            $selectedAlbums = $request->input('albums');

            // Vergelijk de geselecteerde albums met de huidige albums van het lied
            $currentAlbums = $song->albums->pluck('id')->toArray();
            $albumsToAdd = array_diff($selectedAlbums, $currentAlbums);

            // Voeg alleen nieuwe albums toe
            foreach ($albumsToAdd as $albumId) {
                $song->albums()->attach($albumId);
            }
        }

        // Verwijder de geselecteerde albums uit het lied
        if ($request->has('removeAlbums')) {
            $albumsToRemove = $request->input('removeAlbums');
            $song->albums()->detach($albumsToRemove);
        }

        return redirect()->route('songs.show', ['song' => $id])->with('success', 'Song has been updated successfully.');
    }




    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate(
            [
            'title' => 'required|string|max:255',
            'singer' => 'required|string|max:255',
            // Add other validation rules as needed
            ]
        );

        // Create a new Song instance using the validated data
        $song = Song::create($request->only(['title', 'singer']));

        // Redirect to the index page or wherever you want after storing
        return redirect()->route('songs.index')->with('success', 'Song has been added successfully.');
    }

}
