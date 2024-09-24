<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Band;
use App\Models\Album;

class BandController extends Controller
{
    public function index()
    {
        $bands = Band::all();
        return view('bands.index', compact('bands'));
    }

    public function create()
    {
        return view('bands.create');
    }

    public function edit(Band $band)
    {
        $albums = Album::all();
        return view('bands.edit', compact('band', 'albums'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'genre' => 'required|string',
        'founded' => 'required|integer|digits:4',
        'albums' => 'nullable|array', // assuming albums is an array of album IDs
        'album_name' => 'nullable|string|max:255', // assuming you want to associate an album with a name
    ]);

    $band = Band::create($validatedData);

    // Check if albums were selected
    if (!empty($validatedData['albums'])) {
        // Associate the selected albums with their names
        $band->albums()->attach($validatedData['albums'], ['album_name' => $validatedData['album_name']]);
    }

    return redirect()->route('bands.index')->with('success', 'Band is successfully added!');
}


    public function show(Band $band)
    {
        return view('bands.show', compact('band'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'founded' => 'required|integer|digits:4',
            'albums' => 'nullable|array',
            'removeAlbums' => 'nullable|array',
        ]);

        $band = Band::find($id);

        if (!$band) {
            return redirect()->route('bands.index')->with('error', 'Band not found.');
        }

        $band->update([
            'name' => $request->input('name'),
            'genre' => $request->input('genre'),
            'founded' => $request->input('founded'),
        ]);

        // Update the foreign key (band_id) of the selected albums
        if (!empty($request->input('albums'))) {
            Album::whereIn('id', $request->input('albums'))->update(['band_id' => $band->id]);
        }

        // Remove the association for unselected albums
        if (!empty($request->input('removeAlbums'))) {
            Album::whereIn('id', $request->input('removeAlbums'))->update(['band_id' => null]);
        }

        return redirect()->route('bands.index')->with('success', 'Band has been updated successfully.');
    }



    public function destroy(Band $band)
    {
        $band->delete();

        return redirect()->route('bands.index')->with('success', 'Band is successfully deleted!');
    }
}
