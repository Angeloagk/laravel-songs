<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Songs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">

    <header class="bg-indigo-800 text-white text-center py-4">
        <h1 class="text-2xl font-semibold">List of Songs</h1>
    </header>

    <div class="container mx-auto mt-8">
        <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($songs as $song)
            <li class="bg-white shadow p-6 rounded-md">
                <a href="{{ route('songs.show', ['song' => $song->id]) }}" class="text-indigo-600 hover:underline">
                    {{ $song->title }}
                </a>
            </li>
            @endforeach
        </ul>

            <a href="{{ route('songs.create') }}"
                class="block bg-blue-500 text-white py-2 px-4 mt-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Create New Songs
            </a>

    </div>

</body>

</html>
