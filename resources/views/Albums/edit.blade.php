<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold mb-4">Edit Album</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('albums.update', ['album' => $album->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="removeSongs" class="block text-gray-700 text-sm font-bold mb-2">Remove Songs:</label>

                @if ($album->songs)
                    <select name="removeSongs[]" multiple class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline-blue">

                        @foreach ($album->songs as $song)
                            <option value="{{ $song->id }}">{{ $song->title }}</option>
                        @endforeach

                    </select>
                @else
                    <p>No songs available.</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="addSongs" class="block text-gray-700 text-sm font-bold mb-2">Add Songs:</label>

                @php
                    $allSongs = App\Models\Song::all();
                @endphp

                <select name="addSongs[]" multiple class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline-blue">

                    @foreach ($allSongs as $song)
                        <option value="{{ $song->id }}">{{ $song->title }}</option>
                    @endforeach

                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Update Album</button>
        </form>
    </div>
</body>
</html>
