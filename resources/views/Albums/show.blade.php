<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Album</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold mb-4">Show Album</h1>

        <div class="mb-4">
            <p><strong>Name:</strong> {{ $album->name }}</p>
            <p><strong>Year:</strong> {{ $album->year }}</p>
            <p><strong>Times Sold:</strong> {{ $album->times_sold }}</p>
        </div>

        @if ($album->band)
            <div class="mb-4">
                <h2 class="text-2xl font-semibold mt-6">Band:</h2>
                <a href="{{ route('bands.show', ['band' => $album->band->id]) }}" class="text-blue-500 hover:underline">
                    {{ $album->band->name }}
                </a>
            </div>
        @else
            <p>No band</p>
        @endif

        <div class="mb-4">
            <h2 class="text-2xl font-semibold mt-6">Songs:</h2>
            @if ($album->songs && $album->songs->count() > 0)
                <ul class="list-disc pl-6">
                    @foreach ($album->songs as $song)
                        <li>
                            <a href="{{ route('songs.show', ['song' => $song->id]) }}" class="text-blue-500 hover:underline">
                                {{ $song->title }} - {{ $song->singer }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No songs</p>
            @endif
        </div>

        @auth
        <div class="flex space-x-2">
            <a href="{{ route('albums.edit', ['album' => $album->id]) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Edit Album
            </a>
            <form action="{{ route('albums.destroy', ['album' => $album->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 focus:outline-none focus:shadow-outline-red active:bg-red-800">
                    Delete Album
                </button>
            </form>
        </div>
        @endauth
    </div>

    <!-- Navigatielinks -->
    <div class="mt-6">
        <ul class="flex space-x-4">
            <li>
                <a href="{{ route('songs.index') }}" class="text-black-500 hover:underline {{ request()->routeIs('songs.*') ? 'font-bold' : '' }}">Songs</a>
            </li>
            <li>
                <a href="{{ route('albums.index') }}" class="text-black-500 hover:underline {{ request()->routeIs('albums.*') ? 'font-bold' : '' }}">Albums</a>
            </li>
            <li>
                <a href="{{ route('bands.index') }}" class="text-black-500 hover:underline {{ request()->routeIs('bands.*') ? 'font-bold' : '' }}">Bands</a>
            </li>
        </ul>
    </div>
</body>

</html>
