<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Band</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
@auth
    <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold mb-4">Create Band</h1>

        <form action="{{ route('bands.store') }}" method="POST">
            @csrf

            <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full p-2 border border-gray-300 rounded mb-4" required>

            <label for="genre" class="block text-sm font-medium text-gray-600 mb-1">Genre:</label>
            <input type="text" name="genre" value="{{ old('genre') }}"
                class="w-full p-2 border border-gray-300 rounded mb-4" required>

            <label for="founded" class="block text-sm font-medium text-gray-600 mb-1">Founded:</label>
            <input type="text" name="founded" value="{{ old('founded') }}"
                class="w-full p-2 border border-gray-300 rounded mb-4" required>

            <button type="submit"
                class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline-green active:bg-green-800">
                Create Band
