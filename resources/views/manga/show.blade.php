@extends('layouts.app')

@section('content')
    <!-- Hero Banner -->
    <div class="relative h-96 overflow-hidden">
        <!-- Navigation Overlay -->
        <div class="absolute top-0 left-0 w-full z-20 p-4 md:p-6 bg-gradient-to-b from-black/80 to-transparent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center space-x-2 text-sm md:text-base font-medium">
                    <a href="{{ session('back_url', '/manga') }}"
                        class="flex items-center text-gray-300 hover:text-white hover:bg-white/10 px-3 py-1.5 rounded-lg transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>
                    <span class="text-gray-500">/</span>
                    <a href="/manga" class="text-gray-300 hover:text-white transition-colors">Manga</a>
                    <span class="text-gray-500">/</span>
                    <span
                        class="text-pink-400 truncate max-w-[200px] md:max-w-md cursor-default">{{ $manga['title'] }}</span>
                </div>
            </div>
        </div>

        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ $manga['images']['jpg']['large_image_url'] }}" alt="{{ $manga['title'] }}"
                class="w-full h-full object-cover blur-sm scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-gray-900/40"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-end pb-8">
            <div class="flex flex-col md:flex-row gap-6 w-full">
                <!-- Poster -->
                <div class="shrink-0">
                    <img src="{{ $manga['images']['jpg']['image_url'] }}" alt="{{ $manga['title'] }}"
                        class="w-48 h-72 object-cover rounded-2xl shadow-2xl border-2 border-pink-500/30 transform hover:scale-105 transition-transform duration-300">
                </div>

                <!-- Info -->
                <div class="flex-1 space-y-4">
                    <h1 class="text-4xl md:text-5xl font-black text-white mb-2">
                        {{ $manga['title'] }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-4">
                        @if(isset($manga['score']) && $manga['score'])
                            <div
                                class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-white font-bold">{{ number_format($manga['score'], 2) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Info -->
                    <div class="flex flex-wrap gap-3 text-sm">
                        @if(isset($manga['type']))
                            <span
                                class="px-3 py-1 bg-gray-800/80 backdrop-blur-sm rounded-lg text-gray-300 border border-gray-700">
                                {{ $manga['type'] }}
                            </span>
                        @endif
                        @if(isset($manga['chapters']) && $manga['chapters'] != '?')
                            <span
                                class="px-3 py-1 bg-gray-800/80 backdrop-blur-sm rounded-lg text-gray-300 border border-gray-700">
                                {{ $manga['chapters'] }} Chapters
                            </span>
                        @endif
                        @if(isset($manga['volumes']) && $manga['volumes'] != '?')
                            <span
                                class="px-3 py-1 bg-gray-800/80 backdrop-blur-sm rounded-lg text-gray-300 border border-gray-700">
                                {{ $manga['volumes'] }} Volumes
                            </span>
                        @endif
                        @if(isset($manga['status']))
                            <span
                                class="px-3 py-1 bg-gray-800/80 backdrop-blur-sm rounded-lg text-gray-300 border border-gray-700">
                                {{ $manga['status'] }}
                            </span>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4 mt-6">
                        <button onclick="toggleMyList({{ json_encode($manga) }}, 'manga')"
                            data-anime-id="{{ $manga['id'] }}"
                            class="flex-1 bg-gradient-to-r from-pink-600 to-purple-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:bg-pink-600 transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 group">
                            <svg class="w-5 h-5 group-hover:transition-colors" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span>Add to My List</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Synopsis -->
                @if(isset($manga['synopsis']) && $manga['synopsis'])
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-pink-500/20">
                        <h2 class="text-2xl font-bold text-white mb-4">Sinopsis</h2>
                        <div class="text-gray-300 leading-relaxed">
                            {!! nl2br(strip_tags($manga['synopsis'])) !!}
                        </div>
                    </div>
                @endif

                <!-- Genres -->
                @if(isset($manga['genres']) && count($manga['genres']) > 0)
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-pink-500/20">
                        <h2 class="text-2xl font-bold text-white mb-4">Genres</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($manga['genres'] as $genre)
                                <span
                                    class="px-4 py-2 bg-gradient-to-r from-pink-500/30 to-purple-500/30 text-pink-300 rounded-full border border-pink-500/40 font-medium">
                                    {{ $genre['name'] }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Chapters -->
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-pink-500/20">
                    <h2 class="text-2xl font-bold text-white mb-4">Chapters</h2>
                    <div
                        class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                        @php
                            $totalChapters = is_numeric($manga['chapters']) ? (int) $manga['chapters'] : 10;
                        @endphp
                        @for($i = 1; $i <= $totalChapters; $i++)
                            <a href="{{ route('manga.read', [$manga['id'], $i]) }}"
                                class="block p-3 bg-gray-700/50 hover:bg-pink-600/20 rounded-lg border border-transparent hover:border-pink-500/50 transition-all duration-200 group">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs font-bold text-pink-400">CH {{ $i }}</span>
                                </div>
                                <h4 class="text-sm text-gray-200 font-medium group-hover:text-pink-300">
                                    Chapter {{ $i }}
                                </h4>
                            </a>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Statistics -->
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-pink-500/20">
                    <h3 class="text-xl font-bold text-white mb-4">Informasi</h3>
                    <div class="space-y-4">
                        @if(isset($manga['year']))
                            <div>
                                <span class="text-gray-400 text-sm block">Tahun</span>
                                <span class="text-white font-medium">{{ $manga['year'] }}</span>
                            </div>
                        @endif
                        @if(isset($manga['status']))
                            <div>
                                <span class="text-gray-400 text-sm block">Status</span>
                                <span class="text-white font-medium">{{ $manga['status'] }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(55, 65, 81, 0.3);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(236, 72, 153, 0.5);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(236, 72, 153, 0.7);
        }
    </style>
@endsection