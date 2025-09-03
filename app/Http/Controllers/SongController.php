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
        $songs = Song::all();
        return view('songs.index', ['songs' => $songs]);
    }

    public function show($id)
    {
        $song = Song::find($id);
        return view('songs.show', ['song' => $song]);
    }

    public function create(Request $request)
    {
        $api_key = '7defd3431098e35855dd39c3ceffe7d8';
        $title = $request->input('title');

        $response = Http::get('https://ws.audioscrobbler.com/2.0/', [
            'method' => 'track.search',
            'api_key' => $api_key,
            'format' => 'json',
            'track' => $title,
        ]);

        $responseData = $response->json();
        $songsFromAPI = isset($responseData['results']['trackmatches']['track'])
            ? $responseData['results']['trackmatches']['track']
            : [];

        return view('songs.create', ['songsFromAPI' => $songsFromAPI]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'singer' => 'required|string|max:255',
        ]);

        Song::create($request->only(['title', 'singer']));

        return redirect()->route('songs.index')->with('success', 'Song has been added successfully.');
    }

    public function edit($id)
    {
        $song = Song::find($id);
        $albums = Album::all();

        return view('songs.edit', compact('id', 'song', 'albums'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'singer' => 'required|string|max:255',
        ]);

        $song = Song::find($id);
        if (!$song) {
            return redirect()->route('songs.index')->with('error', 'Song not found.');
        }

        $song->update([
            'title' => $request->input('title'),
            'singer' => $request->input('singer'),
        ]);

        // Attach new albums
        if ($request->has('albums')) {
            $selectedAlbums = $request->input('albums');
            $currentAlbums = $song->albums->pluck('id')->toArray();
            $albumsToAdd = array_diff($selectedAlbums, $currentAlbums);

            foreach ($albumsToAdd as $albumId) {
                $song->albums()->attach($albumId);
            }
        }

        // Detach albums to remove
        if ($request->has('removeAlbums')) {
            $song->albums()->detach($request->input('removeAlbums'));
        }

        return redirect()->route('songs.show', ['song' => $id])
            ->with('success', 'Song has been updated successfully.');
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
}
