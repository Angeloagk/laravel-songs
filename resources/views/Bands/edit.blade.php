<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Band: {{ $band->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
    @if (Auth::check())
    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold mb-4">Edit Band: {{ $band->name }}</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('bands.update', ['band' => $band->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Name:</label>
            <input type="text" name="name" value="{{ old('name', $band->name) }}" class="w-full p-2 border border-gray-300 rounded mb-4" required>

            <label for="genre" class="block text-sm font-medium text-gray-600 mb-1">Genre:</label>
            <input type="text" name="genre" value="{{ old('genre', $band->genre) }}" class="w-full p-2 border border-gray-300 rounded mb-4" required>

            <label for="founded" class="block text-sm font-medium text-gray-600 mb-1">Founded:</label>
            <input type="text" name="founded" value="{{ old('founded', $band->founded) }}" class="w-full p-2 border border-gray-300 rounded mb-4" required>

            <div class="mb-4">
                <label for="albums" class="block text-sm font-medium text-gray-600 mb-1">Select Albums:</label>
                <select name="albums[]" multiple class="w-full p-2 border border-gray-300 rounded mb-4">
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}" {{ optional($band->albums)->pluck('id') && in_array($album->id, optional($band->albums)->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $album->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="removeAlbums" class="block text-gray-700 text-sm font-bold mb-2">Remove Albums:</label>
                <select name="removeAlbums[]" multiple class="w-full p-2 border border-gray-300 rounded mb-4">
                    @if ($band->albums)
                        @foreach ($band->albums as $bandAlbum)
                            <option value="{{ $bandAlbum->id }}">
                                {{ $bandAlbum->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Update Band
            </button>
        </form>
    </div>
    @endif
</body>

</html>
