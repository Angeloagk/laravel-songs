<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
        @if ($song)
            <h1 class="text-3xl font-semibold mb-4">{{ $song->title }}</h1>
            <p class="text-gray-600">Singer: {{ $song->singer }}</p>
            <p class="text-gray-600">Created at: {{ $song->created_at }}</p>
            <p class="text-gray-600">Updated at: {{ $song->updated_at }}</p>

            <!-- Display associated albums -->
            <div class="mb-4">

                <h2 class="text-2xl font-semibold mt-6">Albums:</h2>
                @if ($song->albums->count() > 0)
                    <ul class="list-disc pl-6">
                        @foreach ($song->albums as $album)
                            <li>
                                <a href="{{ route('albums.show', ['album' => $album->id]) }}" class="text-blue-500 hover:underline">
                                {{ $album->name }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-700">No albums associated with this song.</p>
                @endif
            </div>

            @if (Auth::check())
            <form action="{{ route('songs.destroy', ['song' => $song->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-red-300">Delete Song</button>
            </form>

            <form action="{{ route('songs.edit', ['song' => $song->id]) }}" method="post">
                @csrf
                @method('GET')
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">Edit Song</button>
            </form>
        @endif
    </div>
    @endif

</body>

</html>
