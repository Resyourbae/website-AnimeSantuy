@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center space-y-4 mb-12">
                <h1
                    class="text-4xl md:text-6xl font-black bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">
                    Genre Anime
                </h1>
                <p class="text-gray-300 text-lg">
                    Jelajahi anime berdasarkan genre favoritmu
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @foreach ($genres as $genre)
                    <a href="{{ route('anime.genre.show', $genre) }}"
                        class="group relative overflow-hidden rounded-xl bg-gray-800/50 backdrop-blur-sm border border-purple-500/20 hover:border-purple-500/50 transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-purple-500/20 p-6 flex items-center justify-center text-center">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-purple-600/10 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>

                        <span
                            class="relative z-10 text-lg font-semibold text-gray-200 group-hover:text-white group-hover:tracking-wider transition-all duration-300">
                            {{ $genre }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection