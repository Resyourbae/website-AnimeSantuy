@extends('layouts.app')

@section('content')
    <!-- Hero Banner -->
    <div class="relative h-96 overflow-hidden">
        <!-- Navigation Overlay -->
        <div class="absolute top-0 left-0 w-full z-20 p-4 md:p-6 bg-gradient-to-b from-black/80 to-transparent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center space-x-2 text-sm md:text-base font-medium">
                    <a href="{{ url()->previous() }}" onclick="if(document.referrer) { history.back(); return false; }"
                        class="flex items-center text-gray-300 hover:text-white hover:bg-white/10 px-3 py-1.5 rounded-lg transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>
                    <span class="text-gray-500">/</span>
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">Beranda</a>
                    <span class="text-gray-500">/</span>
                    <span
                        class="text-blue-400 truncate max-w-[200px] md:max-w-md cursor-default">{{ $anime['title'] }}</span>
                </div>
            </div>
        </div>
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="{{ $anime['images']['jpg']['large_image_url'] ?? $anime['images']['jpg']['image_url'] }}"
                alt="{{ $anime['title'] }}" class="w-full h-full object-cover blur-sm scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-gray-900/40"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-end pb-8">
            <div class="flex flex-col md:flex-row gap-6 w-full">
                <!-- Poster -->
                <div class="flex-shrink-0">
                    <img src="{{ $anime['images']['jpg']['image_url'] }}" alt="{{ $anime['title'] }}"
                        class="w-48 h-72 object-cover rounded-2xl shadow-2xl border-2 border-purple-500/30 transform hover:scale-105 transition-transform duration-300">
                </div>

                <!-- Info -->
                <div class="flex-1 space-y-4">
                    <h1 class="text-4xl md:text-5xl font-black text-white mb-2">
                        {{ $anime['title'] }}
                    </h1>

                    @if(isset($anime['title_english']) && $anime['title_english'])
                        <p class="text-xl text-gray-300">
                            {{ $anime['title_english'] }}
                        </p>
                    @endif

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-4">
                        @if(isset($anime['score']) && $anime['score'])
                            <div
                                class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-white font-bold">{{ number_format($anime['score'], 2) }}</span>
                            </div>
                        @endif

                        @if(isset($anime['rank']) && $anime['rank'])
                            <div class="px-4 py-2 bg-purple-500/30 backdrop-blur-sm rounded-full border border-purple-500/50">
                                <span class="text-purple-300 font-semibold">Rank #{{ $anime['rank'] }}</span>
                            </div>
                        @endif

                        @if(isset($anime['popularity']) && $anime['popularity'])
                            <div class="px-4 py-2 bg-pink-500/30 backdrop-blur-sm rounded-full border border-pink-500/50">
                                <span class="text-pink-300 font-semibold">Popularity #{{ $anime['popularity'] }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Info -->
                    <div class="flex flex-wrap gap-3 text-sm">
                        @if(isset($anime['type']))
                            <span
                                class="px-3 py-1 bg-gray-800/80 backdrop-blur-sm rounded-lg text-gray-300 border border-gray-700">
                                {{ $anime['type'] }}
                            </span>
                        @endif

                        @if(isset($anime['episodes']) && $anime['episodes'])
                            <span
                                class="px-3 py-1 bg-gray-800/80 backdrop-blur-sm rounded-lg text-gray-300 border border-gray-700">
                                {{ $anime['episodes'] }} Episodes
                            </span>
                        @endif

                        @if(isset($anime['status']))
                            <span
                                class="px-3 py-1 bg-gray-800/80 backdrop-blur-sm rounded-lg text-gray-300 border border-gray-700">
                                {{ $anime['status'] }}
                            </span>
                        @endif

                        @if(isset($anime['year']) && $anime['year'])
                            <span
                                class="px-3 py-1 bg-gray-800/80 backdrop-blur-sm rounded-lg text-gray-300 border border-gray-700">
                                {{ $anime['year'] }}
                            </span>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4 mt-6">
                        <button id="addToFavorites"
                            class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg border border-white/10 hover:shadow-purple-500/30 transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2 group">
                            <svg class="w-5 h-5 group-hover:animate-ping" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span id="favText">Favorit</span>
                        </button>
                        <button
                            class="flex-1 bg-white/10 backdrop-blur-md text-white font-bold py-3 px-6 rounded-xl border border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            Bagikan
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
                @if(isset($anime['synopsis']) && $anime['synopsis'])
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-purple-500/20">
                        <h2 class="text-2xl font-bold text-white mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Sinopsis
                        </h2>
                        <div id="synopsisText" class="text-gray-300 leading-relaxed">
                            <p class="line-clamp-4" id="synopsisContent">{!! $anime['synopsis'] !!}</p>
                        </div>
                        <button id="readMoreBtn"
                            class="mt-4 text-purple-400 hover:text-purple-300 font-semibold flex items-center gap-1 transition-colors">
                            <span>Baca Selengkapnya</span>
                            <svg class="w-4 h-4 transform transition-transform" id="readMoreIcon" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                @endif


                <!-- Genres -->
                @if(isset($anime['genres']) && count($anime['genres']) > 0)
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-purple-500/20">
                        <h2 class="text-2xl font-bold text-white mb-4">Genres</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($anime['genres'] as $genre)
                                <span
                                    class="px-4 py-2 bg-gradient-to-r from-purple-500/30 to-pink-500/30 text-purple-300 rounded-full border border-purple-500/40 font-medium hover:border-purple-400 transition-colors cursor-pointer">
                                    {{ $genre['name'] }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Themes -->
                @if(isset($anime['themes']) && count($anime['themes']) > 0)
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-purple-500/20">
                        <h2 class="text-2xl font-bold text-white mb-4">Tema</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($anime['themes'] as $theme)
                                <span
                                    class="px-4 py-2 bg-gradient-to-r from-blue-500/30 to-cyan-500/30 text-blue-300 rounded-full border border-blue-500/40 font-medium">
                                    {{ $theme['name'] }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Episodes -->
                @if(isset($episodes) && count($episodes) > 0)
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-purple-500/20 mt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-bold text-white">Episodes</h2>
                            <button id="sortEpisodesBtn"
                                class="text-xs md:text-sm bg-gray-700 hover:bg-gray-600 text-white px-3 py-1.5 rounded-lg transition-colors flex items-center gap-2 border border-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="sortIcon">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                </svg>
                                <span id="sortText">Terlama</span>
                            </button>
                        </div>
                        <div id="episodesGrid"
                            class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($episodes as $episode)
                                <a href="{{ $episode['url'] ?? '#' }}" target="_blank"
                                    class="block p-3 bg-gray-700/50 hover:bg-blue-600/20 rounded-lg border border-transparent hover:border-blue-500/50 transition-all duration-200 group">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-xs font-bold text-blue-400">EP
                                            {{ $episode['mal_id'] ?? $episode['episode_id'] ?? $loop->iteration }}</span>
                                        @if(isset($episode['aired']) && $episode['aired'])
                                            <span
                                                class="text-[10px] text-gray-500">{{ \Carbon\Carbon::parse($episode['aired'])->format('M d, Y') }}</span>
                                        @endif
                                    </div>
                                    <h4 class="text-sm text-gray-200 font-medium line-clamp-1 group-hover:text-blue-300">
                                        {{ $episode['title'] ?? 'Episode ' . ($episode['mal_id'] ?? $loop->iteration) }}
                                    </h4>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Statistics -->
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-purple-500/20">
                    <h3 class="text-xl font-bold text-white mb-4">Statistik</h3>
                    <div class="space-y-3">
                        @if(isset($anime['scored_by']) && $anime['scored_by'])
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">Penilai</span>
                                <span class="text-white font-semibold">{{ number_format($anime['scored_by']) }}</span>
                            </div>
                        @endif

                        @if(isset($anime['members']) && $anime['members'])
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">Anggota</span>
                                <span class="text-white font-semibold">{{ number_format($anime['members']) }}</span>
                            </div>
                        @endif

                        @if(isset($anime['favorites']) && $anime['favorites'])
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">Favorit</span>
                                <span class="text-white font-semibold">{{ number_format($anime['favorites']) }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Information -->
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-6 border border-purple-500/20">
                    <h3 class="text-xl font-bold text-white mb-4">Informasi</h3>
                    <div class="space-y-4">
                        @if(isset($anime['aired']['string']))
                            <div>
                                <span class="text-gray-400 text-sm block">Tayang</span>
                                <span class="text-white font-medium">{{ $anime['aired']['string'] }}</span>
                            </div>
                        @endif

                        @if(isset($anime['studios']) && count($anime['studios']) > 0)
                            <div>
                                <span class="text-gray-400 text-sm block">Studio</span>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach($anime['studios'] as $studio)
                                        <span
                                            class="text-purple-400 hover:text-purple-300 cursor-pointer">{{ $studio['name'] }}</span>{{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if(isset($anime['source']))
                            <div>
                                <span class="text-gray-400 text-sm block">Sumber</span>
                                <span class="text-white font-medium">{{ $anime['source'] }}</span>
                            </div>
                        @endif

                        @if(isset($anime['duration']))
                            <div>
                                <span class="text-gray-400 text-sm block">Durasi</span>
                                <span class="text-white font-medium">{{ $anime['duration'] }}</span>
                            </div>
                        @endif

                        @if(isset($anime['rating']))
                            <div>
                                <span class="text-gray-400 text-sm block">Rating</span>
                                <span class="text-white font-medium">{{ $anime['rating'] }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- External Links -->
                @if(isset($anime['url']))
                    <a href="{{ $anime['url'] }}" target="_blank"
                        class="block w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg font-semibold text-center hover:shadow-lg hover:shadow-blue-500/50 transform hover:scale-105 transition-all duration-200">
                        View on MyAnimeList
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript for Interactivity -->
    <script>
        // Read More/Less functionality
        const readMoreBtn = document.getElementById('readMoreBtn');
        const synopsisContent = document.getElementById('synopsisContent');
        const readMoreIcon = document.getElementById('readMoreIcon');
        let isExpanded = false;

        if (readMoreBtn && synopsisContent) {
            readMoreBtn.addEventListener('click', () => {
                isExpanded = !isExpanded;

                if (isExpanded) {
                    synopsisContent.classList.remove('line-clamp-4');
                    readMoreBtn.querySelector('span').textContent = 'Read Less';
                    readMoreIcon.style.transform = 'rotate(180deg)';
                } else {
                    synopsisContent.classList.add('line-clamp-4');
                    readMoreBtn.querySelector('span').textContent = 'Read More';
                    readMoreIcon.style.transform = 'rotate(0deg)';
                }
            });
        }

        // Add to Favorites functionality
        const addToFavBtn = document.getElementById('addToFavorites');
        const favText = document.getElementById('favText');
        let isFavorited = false;

        if (addToFavBtn) {
            addToFavBtn.addEventListener('click', () => {
                isFavorited = !isFavorited;

                if (isFavorited) {
                    addToFavBtn.innerHTML = `
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>Added to Favorites</span>
                                                `;
                    addToFavBtn.classList.add('animate-pulse');
                    setTimeout(() => {
                        addToFavBtn.classList.remove('animate-pulse');
                    }, 500);
                } else {
                    addToFavBtn.innerHTML = `
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                    </svg>
                                                    <span>Add to Favorites</span>
                                                `;
                }
            });
        }

        // Smooth entrance animation
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.bg-gray-800\\/50');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.5s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Episode Sorting Logic
            const sortEpisodesBtn = document.getElementById('sortEpisodesBtn');
            const episodesGrid = document.getElementById('episodesGrid');
            const sortText = document.getElementById('sortText');
            const sortIcon = document.getElementById('sortIcon');
            // Default is Ascending (1-N) because we sorted it that way in PHP
            let isAscending = true;

            if (sortEpisodesBtn && episodesGrid) {
                sortEpisodesBtn.addEventListener('click', () => {
                    isAscending = !isAscending;

                    // Get all episode elements
                    const episodes = Array.from(episodesGrid.children);

                    // Reverse the array (since it's already sorted one way, reversing toggles it)
                    episodes.reverse();

                    // Re-append in new order
                    episodesGrid.innerHTML = '';
                    episodes.forEach(ep => episodesGrid.appendChild(ep));

                    // Update UI
                    if (isAscending) {
                        sortText.textContent = 'Terlama'; // Oldest first (1, 2, 3...)
                        sortIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />'; // Arrow Up
                    } else {
                        sortText.textContent = 'Terbaru'; // Newest first (1000, 999...)
                        sortIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4 4m0 0l4-4m-4 4v-12" />'; // Arrow Down
                    }
                });
            }
        });
    </script>
@endsection