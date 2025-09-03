<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Song</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold mb-4">Edit Song: {{ $song->title }}</h1>

        <form action="{{ route('songs.update', ['song' => $id]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Song Name:</label>
                <input type="text" name="title" id="title" value="{{ $song->title }}" class="mt-1 p-2 border rounded-md w-full" required>
            </div>

            <div class="mb-4">
                <label for="singer" class="block text-sm font-medium text-gray-600">Singer:</label>
                <input type="text" name="singer" id="singer" value="{{ $song->singer }}" class="mt-1 p-2 border rounded-md w-full" required>
            </div>

            <div class="mb-4">
                <label for="albums" class="block text-sm font-medium text-gray-600">Select Albums:</label>
                <select name="albums[]" class="mt-1 p-2 border rounded-md w-full" multiple>
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}" {{ in_array($album->id, $song->albums->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $album->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="removeAlbums" class="block text-sm font-medium text-gray-600">Remove Albums:</label>
                <select name="removeAlbums[]" class="mt-1 p-2 border rounded-md w-full" multiple>
                    @foreach ($song->albums as $album)
                        <option value="{{ $album->id }}">
                            {{ $album->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:border-indigo-300">Update Song</button>
        </form>
    </div>
@endif
</body>

</html>
