<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Song</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold mb-4">Edit Song: {{ $song->title }}</h1>

    <form action="{{ route('songs.update', $song->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Titel -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-600">Song Name:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $song->title) }}"
                   class="mt-1 p-2 border rounded-md w-full" required>
        </div>

        <!-- Singer -->
        <div class="mb-4">
            <label for="singer" class="block text-sm font-medium text-gray-600">Singer:</label>
            <input type="text" name="singer" id="singer" value="{{ old('singer', $song->singer) }}"
                   class="mt-1 p-2 border rounded-md w-full" required>
        </div>

        <!-- Albums toevoegen -->
        <div class="mb-4">
            <label for="albums" class="block text-sm font-medium text-gray-600">Select Albums:</label>
            <select name="albums[]" id="albums" multiple
                    class="mt-1 p-2 border rounded-md w-full">
                @foreach ($albums as $album)
                    <option value="{{ $album->id }}"
                        {{ in_array($album->id, $song->albums->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $album->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Albums verwijderen -->
        <div class="mb-4">
            <label for="removeAlbums" class="block text-sm font-medium text-gray-600">Remove Albums:</label>
            <select name="removeAlbums[]" id="removeAlbums" multiple
                    class="mt-1 p-2 border rounded-md w-full">
                @foreach ($song->albums as $album)
                    <option value="{{ $album->id }}">{{ $album->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Update knop -->
        <button type="submit"
                class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
            ✅ Update Song
        </button>

        <a href="{{ route('songs.show', $song->id) }}"
           class="ml-4 text-gray-600 hover:underline">⬅ Cancel</a>
    </form>
</div>

</body>
</html>
