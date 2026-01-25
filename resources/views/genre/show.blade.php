@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center space-y-4 mb-12">
                <h1
                    class="text-4xl md:text-5xl font-black bg-gradient-to-r from-blue-400 to-cyan-500 bg-clip-text text-transparent">
                    Genre: {{ $genre }}
                </h1>
                <p class="text-gray-300">
                    Menampilkan anime dengan genre {{ $genre }}
                </p>
            </div>

            <!-- Anime Grid -->
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
                                <!-- Gradient Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>

                                <!-- Score Badge -->
                                @if(isset($anime['score']) && $anime['score'])
                                    <div class="absolute top-3 right-3">
                                        <div
                                            class="px-3 py-1.5 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center space-x-1 shadow-lg">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span
                                                class="text-white font-bold text-sm">{{ number_format($anime['score'], 1) }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3
                                    class="text-white font-semibold text-base line-clamp-2 mb-2 group-hover:text-purple-400 transition-colors">
                                    {{ $anime['title'] }}
                                </h3>

                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-400">
                                        {{ $anime['type'] ?? 'TV' }}
                                    </span>
                                    @if(isset($anime['episodes']) && $anime['episodes'])
                                        <span class="text-gray-400">
                                            {{ $anime['episodes'] }} eps
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center space-x-4">
                @if ($pagination['currentPage'] > 1)
                    <a href="{{ route('anime.genre.show', ['genre' => $genre, 'page' => $pagination['currentPage'] - 1]) }}"
                        class="px-6 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors border border-gray-700">
                        Previous
                    </a>
                @endif

                @if ($pagination['hasNextPage'])
                    <a href="{{ route('anime.genre.show', ['genre' => $genre, 'page' => $pagination['currentPage'] + 1]) }}"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors shadow-lg shadow-blue-500/30">
                        Next
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection