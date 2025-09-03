<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold mb-4">{{ $song->title }}</h1>
    <p class="text-gray-700 mb-2">🎤 Singer: <strong>{{ $song->singer }}</strong></p>

    <div class="flex space-x-4 mt-6">
        <!-- Edit knop -->
        <a href="{{ route('songs.edit', $song->id) }}"
           class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            ✏️ Edit
        </a>

        <!-- Delete knop -->
        <form action="{{ route('songs.destroy', $song->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this song?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                🗑️ Delete
            </button>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('songs.index') }}" class="text-indigo-600 hover:underline">⬅ Back to list</a>
    </div>
</div>

</body>
</html>
