<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold mb-4">Albums</h1>

        <ul>
            @foreach($albums as $album)
                <li class="mb-2">
                    <a href="{{ route('albums.show', ['album' => $album->id]) }}" class="text-blue-500 hover:underline">{{ $album->name }}</a>
                </li>
            @endforeach
        </ul>

        @auth
        <a href="{{ route('albums.create') }}" class="block bg-blue-500 text-white py-2 px-4 mt-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Create New Album</a>
        @endauth
    </div>
</body>
</html>

</html>
