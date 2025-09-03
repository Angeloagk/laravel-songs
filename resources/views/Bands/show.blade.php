<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $band->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold mb-4">{{ $band->name }}</h1>

        <p class="text-gray-700 mb-2">Genre: {{ $band->genre }}</p>
        <p class="text-gray-700 mb-2">Founded: {{ $band->founded }}</p>

        <h2 class="text-2xl font-semibold mt-6">Albums:</h2>
        @if ($band->albums->count() > 0)
            <ul class="list-disc pl-6">
                @foreach ($band->albums as $album)
                    <li>
                        <a href="{{ route('albums.show', ['album' => $album->id]) }}" class="text-blue-500 hover:underline">{{ $album->name }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-700">No albums available.</p>
        @endif

        @if (Auth::check())
            <div class="flex mt-6">
                <a href="{{ route('bands.edit', ['band' => $band->id]) }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 mr-4">
                    Edit Band
                </a>

                <form action="{{ route('bands.destroy', ['band' => $band->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:border-red-300">
                        Delete Band
                    </button>
                </form>
            </div>
        @endif
    </div>

</body>

</html>
