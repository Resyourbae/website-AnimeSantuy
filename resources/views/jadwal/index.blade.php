@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center space-y-4 mb-12">
                <h1
                    class="text-4xl md:text-5xl font-black bg-gradient-to-r from-orange-400 to-red-600 bg-clip-text text-transparent">
                    Jadwal Tayang
                </h1>
                <p class="text-gray-300">
                    Jadwal rilis episode terbaru minggu ini
                </p>
            </div>

            <div class="space-y-12">
                @foreach ($schedule as $day => $animes)
                    <div class="relative">
                        <!-- Day Header -->
                        <div class="sticky top-20 z-10 flex items-center mb-6">
                            <div
                                class="bg-gray-900/90 backdrop-blur-md px-6 py-2 rounded-full border border-blue-500/30 shadow-lg shadow-blue-500/10">
                                <h2 class="text-2xl font-bold text-white">{{ $day }}</h2>
                            </div>
                            <div class="h-px flex-grow bg-gradient-to-r from-blue-500/30 to-transparent ml-4"></div>
                        </div>

                        <!-- Anime Grid for the Day -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                            @foreach ($animes as $anime)
                                <a href="{{ route('anime.show', $anime['mal_id'] ?? $anime['id'] ?? 0) }}"
                                    class="block anime-card group cursor-pointer">
                                    <div
                                        class="relative overflow-hidden rounded-2xl bg-gray-800/50 backdrop-blur-sm border border-purple-500/20 hover:border-purple-500/50 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/30">
                                        <!-- Image Container -->
                                        <div class="relative aspect-[3/4] overflow-hidden">
                                            <img src="{{ $anime['images']['jpg']['image_url'] }}" alt="{{ $anime['title'] }}"
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                                loading="lazy">

                                            <!-- Time Badge -->
                                            <div class="absolute top-3 left-3">
                                                <div
                                                    class="px-3 py-1.5 bg-black/70 backdrop-blur-sm rounded-full border border-blue-500/30 flex items-center space-x-1">
                                                    <svg class="w-3 h-3 text-blue-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="text-white font-bold text-xs">{{ $anime['airing_time'] }}</span>
                                                </div>
                                            </div>

                                            <!-- Episode Badge -->
                                            <div class="absolute bottom-3 right-3">
                                                <div class="px-3 py-1 bg-red-600/90 backdrop-blur-sm rounded-lg shadow-lg">
                                                    <span class="text-white font-bold text-xs">Ep
                                                        {{ $anime['airing_episode'] }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="p-4">
                                            <h3
                                                class="text-white font-semibold text-sm line-clamp-2 md:text-base group-hover:text-purple-400 transition-colors">
                                                {{ $anime['title'] }}
                                            </h3>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection