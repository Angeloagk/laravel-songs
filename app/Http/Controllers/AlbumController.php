<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Song;
use App\Models\Band;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        $bands = Band::all();
        return view('albums.create', compact('bands'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'nullable|integer|digits:4',
            'times_sold' => 'nullable|integer',
            'band_id' => 'required|exists:bands,id',
            'songs' => 'nullable|array',
        ]);

        DB::transaction(function () use ($validatedData) {
            $album = new Album($validatedData);
            $album->save();

            if (!empty($validatedData['songs'])) {
                $songs = Song::find($validatedData['songs']);
                foreach ($songs as $song) {
                    $album->songs()->attach($song, [
                        'title' => $song->title,
                        'singer' => $song->singer
                    ]);
                }
            }

            if (!empty($validatedData['band_id'])) {
                $band = Band::find($validatedData['band_id']);
                $album->band()->associate($band);
            }
        });

        return redirect()->route('albums.index')->with('success', 'Album is successfully added!');
    }

    public function show($id)
    {
        $album = Album::with('band')->findOrFail($id);
        $bandName = $album->band ? $album->band->name : 'No Band';

        return view('albums.show', compact('album', 'bandName'));
    }

    public function edit(Album $album)
    {
        $songs = Song::all();
        $selectedSongs = $album->songs->pluck('id')->toArray();

        return view('albums.edit', compact('album', 'songs', 'selectedSongs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'addSongs' => 'nullable|array',
            'removeSongs' => 'nullable|array',
        ]);

        $album = Album::find($id);
        if (!$album) {
            return redirect()->route('albums.index')->with('error', 'Album not found.');
        }

        if ($request->has('addSongs')) {
            $album->songs()->sync($request->input('addSongs'));
        }

        if ($request->has('removeSongs')) {
            $album->songs()->detach($request->input('removeSongs'));
        }

        return redirect()->route('albums.show', ['album' => $id])
            ->with('success', 'Album has been updated successfully.');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album is successfully deleted!');
    }
}
