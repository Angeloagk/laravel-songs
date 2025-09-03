<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Song</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    @auth
    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold mb-4">Create a New Song</h1>

        <!-- Toont nummers van de Last.fm API -->
        <ul>
            @foreach($songsFromAPI as $song)
            <li>
                {{ $song['name'] }} by {{ $song['artist'] }}
                <form action="{{ route('songs.store') }}" method="post" style="display: inline;">
                    @csrf
                    <input type="hidden" name="title" value="{{ $song['name'] }}">
                    <input type="hidden" name="singer" value="{{ $song['artist'] }}">
                    <button type="submit">Add Song</button>
                </form>
            </li>
            @endforeach
        </ul>

        <!-- Formulier voor handmatige invoer -->
        <form action="{{ route('songs.store') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Song Name:</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 w-full">
            </div>
            <div class="mb-4">
                <label for="singer" class="block text-sm font-medium text-gray-600">Singer:</label>
                <input type="text" name="singer" id="singer" required
                    class="mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 w-full">
            </div>
            <button type="submit"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">Add
                Song</button>
        </form>
    </div>
    @endauth

</body>

</html>
