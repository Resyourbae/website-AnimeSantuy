@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-10 text-center md:text-left">
                <h1
                    class="text-4xl md:text-6xl font-black text-white mb-2 leading-tight tracking-tight uppercase font-['Orbitron']">
                    <span
                        class="bg-gradient-to-r from-pink-400 via-purple-500 to-pink-600 bg-clip-text text-transparent italic">
                        Manga
                    </span>
                    <span class="text-white drop-shadow-lg">Universe</span>
                </h1>
                <div class="h-1 w-24 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full mb-6 mx-auto md:mx-0"></div>

                <!-- Search & Filters Bar -->
                <form action="{{ route('manga.index') }}" method="GET" class="space-y-6">
                    <!-- Top Bar: Search + Categories -->
                    <div class="flex flex-col lg:flex-row gap-4 items-center">
                        <!-- Search Input -->
                        <div class="relative w-full lg:max-w-md group">
                            <input type="text" name="q" value="{{ $search }}" placeholder="Cari judul manga..."
                                class="w-full bg-gray-800/50 border border-white/10 text-white pl-12 pr-4 py-3 rounded-xl focus:ring-2 focus:ring-pink-500/50 focus:border-pink-500 outline-none transition-all placeholder-gray-500">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500 group-focus-within:text-pink-400 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <!-- Category Tabs -->
                        <div class="flex bg-gray-800/30 p-1 rounded-xl border border-white/5 w-full lg:w-auto">
                            <button type="submit" onclick="document.getElementById('category_input').value='populer'"
                                class="flex-1 lg:flex-none px-6 py-2 rounded-lg text-sm font-bold transition-all {{ $category == 'populer' ? 'bg-pink-600 text-white shadow-lg shadow-pink-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                Populer
                            </button>
                            <button type="submit" onclick="document.getElementById('category_input').value='terbaru'"
                                class="flex-1 lg:flex-none px-6 py-2 rounded-lg text-sm font-bold transition-all {{ $category == 'terbaru' ? 'bg-pink-600 text-white shadow-lg shadow-pink-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                Terbaru
                            </button>
                            <button type="submit" onclick="document.getElementById('category_input').value='tamat'"
                                class="flex-1 lg:flex-none px-6 py-2 rounded-lg text-sm font-bold transition-all {{ $category == 'tamat' ? 'bg-pink-600 text-white shadow-lg shadow-pink-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                                Tamat
                            </button>
                        </div>

                        <!-- Current Category State -->
                        <input type="hidden" name="category" value="{{ $category }}" id="category_input">
                    </div>

                    <!-- Genre Filter Section -->
                    <div class="bg-gray-800/30 rounded-2xl p-6 border border-white/5">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filter Genre
                            </h3>
                            <button type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-pink-600 to-purple-600 text-white text-xs font-bold rounded-full hover:scale-105 transition-transform">
                                Terapkan Filter
                            </button>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                            @php
                                $allGenres = ['Action', 'Adventure', 'Comedy', 'Drama', 'Ecchi', 'Fantasy', 'Horror', 'Mahou Shoujo', 'Mecha', 'Music', 'Mystery', 'Psychological', 'Romance', 'Sci-Fi', 'Slice of Life', 'Sports', 'Supernatural', 'Thriller'];
                            @endphp
                            @foreach($allGenres as $genre)
                                <label class="group flex items-center cursor-pointer">
                                    <div class="relative flex items-center h-full">
                                        <input type="checkbox" name="genres[]" value="{{ $genre }}"
                                            class="peer appearance-none w-5 h-5 bg-gray-700/50 border border-white/10 rounded-md checked:bg-pink-600 checked:border-pink-600 transition-all cursor-pointer"
                                            {{ in_array($genre, $selectedGenres) ? 'checked' : '' }}>
                                        <svg class="absolute w-3.5 h-3.5 text-white pointer-events-none opacity-0 peer-checked:opacity-100 left-[3px] transition-opacity"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span
                                        class="ml-2 text-sm text-gray-400 group-hover:text-white transition-colors">{{ $genre }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>

            <!-- Manga Grid -->
            @if(count($mangas) > 0)
                <div id="mangaGrid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($mangas as $manga)
                        <a href="{{ route('manga.show', $manga['id']) }}" class="block group cursor-pointer relative">
                            <div
                                class="relative overflow-hidden rounded-xl bg-gray-800/50 backdrop-blur-sm border border-white/5 hover:border-pink-500/50 transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-pink-500/20">
                                <!-- Image Container -->
                                <div class="relative aspect-[3/4] overflow-hidden">
                                    <img src="{{ $manga['images']['jpg']['large_image_url'] }}" alt="{{ $manga['title'] }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                        loading="lazy">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>

                                    <!-- Score Badge -->
                                    @if(isset($manga['score']) && $manga['score'])
                                        <div
                                            class="absolute top-2 right-2 px-2 py-1 bg-black/60 backdrop-blur-md rounded text-xs font-bold text-yellow-400 flex items-center shadow-lg border border-white/10">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            {{ number_format($manga['score'], 1) }}
                                        </div>
                                    @endif

                                    <!-- Heart Button (My List) -->
                                    <button onclick="event.preventDefault(); toggleMyList({{ json_encode($manga) }}, 'manga')"
                                        class="absolute top-2 left-2 p-2 rounded-full bg-black/40 backdrop-blur-sm hover:bg-pink-600 transition-all active:scale-95 group/heart z-10"
                                        data-anime-id="{{ $manga['id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 text-white transition-colors duration-300" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Content -->
                                <div class="p-3">
                                    <h3
                                        class="text-gray-100 font-semibold text-sm line-clamp-2 mb-1 group-hover:text-pink-400 transition-colors">
                                        {{ $manga['title'] }}
                                    </h3>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>{{ $manga['type'] ?? 'Manga' }}</span>
                                        <span>{{ $manga['chapters'] ?? '?' }} Ch</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Load More Button -->
                @if(isset($pagination['hasNextPage']) && $pagination['hasNextPage'])
                    <div class="mt-12 text-center">
                        <button id="loadMoreBtn" onclick="loadMoreManga()"
                            class="px-8 py-3 bg-gradient-to-r from-pink-600 to-purple-600 text-white font-bold rounded-xl hover:from-pink-500 hover:to-purple-500 transition-all shadow-lg hover:shadow-pink-500/50">
                            Load More Manga
                        </button>
                    </div>
                @endif
            @else
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-600">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-400 text-xl font-medium">Manga tidak ditemukan</p>
                    <p class="text-gray-600 mt-2">Coba gunakan kata kunci atau filter lain.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        let currentPage = {{ $pagination['currentPage'] ?? 1 }};
        let isLoading = false;

        // Context for pagination
        const searchParams = new URLSearchParams(window.location.search);

        async function loadMoreManga() {
            if (isLoading) return;
            isLoading = true;

            const btn = document.getElementById('loadMoreBtn');
            btn.textContent = 'Loading...';
            btn.disabled = true;

            try {
                // Keep existing filters
                searchParams.set('page', currentPage + 1);

                const response = await fetch(`/manga?${searchParams.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const result = await response.json();

                if (result.data && result.data.length > 0) {
                    const grid = document.getElementById('mangaGrid');
                    result.data.forEach(manga => {
                        const card = createMangaCard(manga);
                        grid.insertAdjacentHTML('beforeend', card);
                    });

                    currentPage++;

                    if (!result.pagination.hasNextPage) {
                        btn.remove();
                    }
                }
            } catch (error) {
                console.error('Error loading more manga:', error);
            } finally {
                btn.textContent = 'Load More Manga';
                btn.disabled = false;
                isLoading = false;
            }
        }

        function createMangaCard(manga) {
            const score = manga.score ? `
                        <div class="absolute top-2 right-2 px-2 py-1 bg-black/60 backdrop-blur-md rounded text-xs font-bold text-yellow-400 flex items-center shadow-lg border border-white/10">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            ${parseFloat(manga.score).toFixed(1)}
                        </div>` : '';

            return `
                        <a href="/manga/${manga.id}" class="block group cursor-pointer relative">
                            <div class="relative overflow-hidden rounded-xl bg-gray-800/50 backdrop-blur-sm border border-white/5 hover:border-pink-500/50 transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-pink-500/20">
                                <div class="relative aspect-[3/4] overflow-hidden">
                                    <img src="${manga.images.jpg.large_image_url}" 
                                         alt="${manga.title}"
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    ${score}
                                    <button onclick="event.preventDefault(); toggleMyList(${JSON.stringify(manga).replace(/"/g, '&quot;')}, 'manga')" 
                                            class="absolute top-2 left-2 p-2 rounded-full bg-black/40 backdrop-blur-sm hover:bg-pink-600 transition-all active:scale-95 group/heart z-10"
                                            data-anime-id="${manga.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white transition-colors duration-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-3">
                                    <h3 class="text-gray-100 font-semibold text-sm line-clamp-2 mb-1 group-hover:text-pink-400 transition-colors">
                                        ${manga.title}
                                    </h3>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>${manga.type || 'Manga'}</span>
                                        <span>${manga.chapters || '?'} Ch</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    `;
        }
    </script>
@endsection