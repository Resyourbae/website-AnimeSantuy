@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 to-black py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <div class="mb-4">
                <a href="#" onclick="history.back(); return false;"
                    class="inline-flex items-center text-gray-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Detail Anime
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Main Video Player -->
                <div class="lg:col-span-3 space-y-4">
                    <!-- Video Container -->
                    <div class="relative bg-black rounded-xl overflow-hidden shadow-2xl group" style="aspect-ratio: 16/9;">
                        @if(isset($anime['trailer']['site']) && $anime['trailer']['site'] === 'youtube' && $anime['trailer']['id'])
                            <iframe
                                src="https://www.youtube.com/embed/{{ $anime['trailer']['id'] }}?autoplay=0&controls=1&rel=0&iv_load_policy=3"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen class="w-full h-full absolute inset-0 z-10">
                            </iframe>
                            <!-- Overlay Warning for Trailer -->
                            <div
                                class="absolute top-0 left-0 w-full p-4 bg-gradient-to-b from-black/80 to-transparent z-20 pointer-events-none">
                                <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">TRAILER</span>
                                <span class="text-gray-300 text-xs ml-2">Episode preview</span>
                            </div>
                        @else
                            <!-- No Trailer - Static Image -->
                            <img src="{{ $anime['images']['jpg']['large_image_url'] }}"
                                class="w-full h-full object-cover opacity-50 absolute inset-0">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                    <p class="text-gray-400 font-medium">Preview tidak tersedia</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Streaming Sources -->
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-4 border border-purple-500/20">
                        <h3 class="text-white font-bold mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tonton Full Episode
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                            <!-- Official Source if Available -->
                            @php
                                $currentEpData = collect($episodes)->firstWhere('mal_id', $currentEpisode);
                            @endphp

                            @if(isset($currentEpData['url']) && $currentEpData['url'] != '#')
                                <a href="{{ $currentEpData['url'] }}" target="_blank"
                                    class="flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white rounded-lg font-semibold transition-all shadow-lg shadow-blue-900/30">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Sumber Resmi
                                </a>
                            @endif

                            <!-- Youtube Search -->
                            <a href="https://www.youtube.com/results?search_query={{ urlencode($anime['title'] . ' Episode ' . $currentEpisode . ' English Sub') }}"
                                target="_blank"
                                class="flex items-center justify-center gap-2 px-4 py-3 bg-red-600 hover:bg-red-500 text-white rounded-lg font-semibold transition-all shadow-lg shadow-red-900/30">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                                </svg>
                                Cari di YouTube
                            </a>

                            <!-- Bstation Search -->
                            <a href="https://www.bilibili.tv/en/search-result?q={{ urlencode($anime['title'] . ' Episode ' . $currentEpisode) }}"
                                target="_blank"
                                class="flex items-center justify-center gap-2 px-4 py-3 bg-pink-500 hover:bg-pink-400 text-white rounded-lg font-semibold transition-all shadow-lg shadow-pink-900/30">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z" />
                                </svg>
                                Cari di Bstation
                            </a>
                        </div>
                        <p class="text-gray-500 text-xs mt-3 text-center">
                            *Kami mengarahkan ke sumber legal atau pencarian untuk mendukung pembuat anime.
                        </p>
                    </div>

                    <!-- Episode Info & Navigation -->
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-6 border border-purple-500/20">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h1 class="text-2xl font-bold text-white mb-2">{{ $anime['title'] }}</h1>
                                <p class="text-gray-400">Episode {{ $currentEpisode }}</p>
                            </div>

                            <!-- Episode Navigation -->
                            <div class="flex gap-3">
                                @if($currentEpisode > 1)
                                    <a href="{{ route('anime.watch', [$anime['id'], $currentEpisode - 1]) }}"
                                        class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                        Previous
                                    </a>
                                @endif

                                @if(isset($episodes) && count($episodes) > $currentEpisode)
                                    <a href="{{ route('anime.watch', [$anime['id'], $currentEpisode + 1]) }}"
                                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center gap-2">
                                        Next
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Anime Description -->
                    @if(isset($anime['synopsis']))
                        <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-6 border border-purple-500/20">
                            <h3 class="text-xl font-bold text-white mb-3">Sinopsis</h3>
                            <p class="text-gray-300 leading-relaxed line-clamp-3">{{ $anime['synopsis'] }}</p>
                        </div>
                    @endif
                </div>

                <!-- Episode List Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-4 border border-purple-500/20 sticky top-20">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Episode List
                        </h3>

                        <div class="space-y-2 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                            @if(isset($episodes) && count($episodes) > 0)
                                @foreach($episodes as $ep)
                                    @php
                                        $epNumber = $ep['mal_id'] ?? $ep['episode_id'] ?? $loop->iteration;
                                        $isActive = $epNumber == $currentEpisode;
                                    @endphp

                                    <a href="{{ route('anime.watch', [$anime['id'], $epNumber]) }}"
                                        class="block p-3 rounded-lg transition-all {{ $isActive ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-gray-700/50 hover:bg-gray-700 text-gray-300' }}">
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold">EP {{ $epNumber }}</span>
                                            @if($isActive)
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                        <p class="text-xs mt-1 truncate {{ $isActive ? 'text-blue-100' : 'text-gray-500' }}">
                                            {{ $ep['title'] ?? 'Episode ' . $epNumber }}
                                        </p>
                                    </a>
                                @endforeach
                            @else
                                <p class="text-gray-500 text-sm text-center py-4">No episodes available</p>
                            @endif
                        </div>
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
            background: rgba(147, 51, 234, 0.5);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(147, 51, 234, 0.7);
        }
    </style>
@endsection