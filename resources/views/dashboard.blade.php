<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-900 dark:text-gray-100">{{ __("You're logged in!") }}</p>

                <!-- Navigatielinks -->
                <div class="mt-6">
                    <ul class="flex space-x-4">
                        <li>
                            <a href="{{ route('songs.index') }}"
                                class="text-blue-500 hover:underline {{ request()->routeIs('songs.*') ? 'font-bold' : '' }}">Songs</a>
                        </li>
                        <li>
                            <a href="{{ route('albums.index') }}"
                                class="text-blue-500 hover:underline {{ request()->routeIs('albums.*') ? 'font-bold' : '' }}">Albums</a>
                        </li>
                        <li>
                            <a href="{{ route('bands.index') }}"
                                class="text-blue-500 hover:underline {{ request()->routeIs('bands.*') ? 'font-bold' : '' }}">Bands</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:underline">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
