<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SongController extends Controller
{
    // 🔹 Lijst van alle songs
    public function index()
    {
        $songs = Song::all();

        return view('songs.index', compact('songs'));
    }

    // 🔹 Detailpagina van 1 song
    public function show($id)
    {
        $song = Song::findOrFail($id); // Fail als de song niet bestaat

        return view('songs.show', compact('song'));
    }

    // 🔹 Create pagina + ophalen data van API
    public function create(Request $request)
    {
        $api_key = '7defd3431098e35855dd39c3ceffe7d8';
        $title = $request->input('title');

        $songsFromAPI = [];

        if ($title) {
            $response = Http::get('https://ws.audioscrobbler.com/2.0/', [
                'method' => 'track.search',
                'api_key' => $api_key,
                'format' => 'json',
                'track' => $title,
            ]);

            $responseData = $response->json();
            $songsFromAPI = $responseData['results']['trackmatches']['track'] ?? [];
        }

        return view('songs.create', compact('songsFromAPI'));
    }

    // 🔹 Song opslaan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'singer' => 'required|string|max:255',
        ]);

        Song::create($request->only(['title', 'singer']));

        return redirect()->route('songs.index')
            ->with('success', 'Song has been added successfully.');
    }

    // 🔹 Edit pagina
    public function edit($id)
    {
        $song = Song::findOrFail($id);
        $albums = Album::all();

        return view('songs.edit', compact('song', 'albums'));
    }

    // 🔹 Update song
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'singer' => 'required|string|max:255',
        ]);

        $song = Song::findOrFail($id);

        $song->update([
            'title' => $request->title,
            'singer' => $request->singer,
        ]);

        // 🔹 Nieuwe albums koppelen
        if ($request->filled('albums')) {
            $song->albums()->syncWithoutDetaching($request->albums);
        }

        // 🔹 Albums verwijderen
        if ($request->filled('removeAlbums')) {
            $song->albums()->detach($request->removeAlbums);
        }

        return redirect()->route('songs.show', $song->id)
            ->with('success', 'Song has been updated successfully.');
    }

    // 🔹 Verwijder song
    public function destroy($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();

        return redirect()->route('songs.index')
            ->with('success', 'Song has been deleted successfully.');
    }
}
