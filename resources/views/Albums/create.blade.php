<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Album</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto my-8 p-8 bg-white rounded shadow-md">
        <h1 class="text-3xl font-bold mb-6">Create Album</h1>

        @auth
        <form action="{{ route('albums.store') }}" method="POST">
            @csrf

            <label for="name" class="block mb-2">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 mb-4" required>

            <label for="year" class="block mb-2">Year:</label>
            <input type="text" name="year" value="{{ old('year') }}" class="w-full border p-2 mb-4">

            <label for="times_sold" class="block mb-2">Times Sold:</label>
            <input type="text" name="times_sold" value="{{ old('times_sold') }}" class="w-full border p-2 mb-4">

            <label for="band_id" class="block mb-2">Band:</label>
            <select name="band_id" class="w-full border p-2 mb-4" required>
                @foreach($bands as $band)
                    <option value="{{ $band->id }}">{{ $band->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Album</button>
        </form>
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
