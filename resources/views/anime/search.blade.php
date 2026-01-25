@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center space-y-4 mb-12">
                <h1
                    class="text-3xl md:text-5xl font-black bg-gradient-to-r from-blue-400 to-purple-600 bg-clip-text text-transparent">
                    Hasil Pencarian
                </h1>
                <p class="text-gray-300 text-lg">
                    Menampilkan hasil untuk: "<span class="text-white font-semibold">{{ $query }}</span>"
                </p>

                <!-- Search Bar (Active) -->
                <div class="relative max-w-xl mx-auto mt-6 group z-50">
                    <form action="{{ route('anime.search') }}" method="GET" class="relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200">
                        </div>
                        <div class="relative">
                            <input type="text" name="q" value="{{ $query }}" id="searchPageInput"
                                class="block w-full p-4 pl-12 pr-12 text-sm md:text-base text-gray-100 bg-gray-900 border border-gray-700 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 transition-all shadow-xl"
                                placeholder="Cari anime lain..." autocomplete="off">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <!-- Loading Spinner -->
                            <div id="searchPageLoading" class="absolute inset-y-0 right-0 flex items-center pr-4 hidden">
                                <svg class="animate-spin w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </form>

                    <!-- Live Search Results Dropdown -->
                    <div id="searchPageResults"
                        class="absolute w-full mt-2 bg-gray-900/95 backdrop-blur-xl border border-gray-700 rounded-2xl shadow-2xl overflow-hidden hidden transition-all duration-300 z-50 max-h-[80vh] overflow-y-auto">
                        <!-- Results injected here -->
                    </div>
                </div>
            </div>

            @if(count($animes) > 0)
                <!-- Anime Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
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
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>

                                    @if(isset($anime['score']) && $anime['score'])
                                        <div
                                            class="absolute top-2 right-2 px-2 py-1 bg-yellow-500/90 rounded-md text-xs font-bold text-black shadow-lg">
                                            {{ number_format($anime['score'], 1) }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-3">
                                    <h3
                                        class="text-white font-semibold text-sm line-clamp-2 mb-1 group-hover:text-purple-400 transition-colors">
                                        {{ $anime['title'] }}
                                    </h3>
                                    <div class="flex items-center justify-between text-xs text-gray-400">
                                        <span>{{ $anime['type'] ?? 'TV' }}</span>
                                        <span>{{ $anime['year'] ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center space-x-4">
                    @if ($pagination['currentPage'] > 1)
                        <a href="{{ route('anime.search', ['q' => $query, 'page' => $pagination['currentPage'] - 1]) }}"
                            class="px-6 py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition-colors border border-gray-700">
                            Previous
                        </a>
                    @endif

                    @if ($pagination['hasNextPage'])
                        <a href="{{ route('anime.search', ['q' => $query, 'page' => $pagination['currentPage'] + 1]) }}"
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors shadow-lg shadow-blue-500/30">
                            Next
                        </a>
                    @endif
                </div>
            @else
                <!-- No Results -->
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-500 mb-2">Tidak ada hasil ditemukan</h3>
                    <p class="text-gray-600">Coba kata kunci lain atau periksa ejaanmu.</p>
                </div>
            @endif
        </div>
    </div>
    <script>
        // Live Search Script for Search Page
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchPageInput');
            const searchResults = document.getElementById('searchPageResults');
            const searchLoading = document.getElementById('searchPageLoading');
            let debounceTimer;

            // Only run if elements exist
            if (!searchInput || !searchResults) return;

            searchInput.addEventListener('input', function () {
                const query = this.value.trim();

                clearTimeout(debounceTimer);

                // Redirect to home if input is cleared
                if (query.length === 0) {
                    sessionStorage.removeItem('home_search_query');
                    window.location.href = '/';
                    return;
                }

                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    searchResults.innerHTML = '';
                    searchLoading.classList.add('hidden');
                    return;
                }

                searchLoading.classList.remove('hidden'); // Show immediately

                debounceTimer = setTimeout(() => {
                    fetchResults(query);
                }, 400); // 400ms debounce
            });

            // Close results when clicking outside
            document.addEventListener('click', (e) => {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });

            async function fetchResults(query) {
                try {
                    const response = await fetch(`{{ route('anime.search') }}?q=${encodeURIComponent(query)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) throw new Error('Network response was not ok');

                    const data = await response.json();
                    renderResults(data);
                } catch (error) {
                    console.error('Error fetching search results:', error);
                } finally {
                    searchLoading.classList.add('hidden');
                }
            }

            function renderResults(animes) {
                if (animes.length === 0) {
                    searchResults.innerHTML = `
                                            <div class="p-4 text-center text-gray-400">
                                                Tidak ada hasil ditemukan.
                                            </div>
                                        `;
                    searchResults.classList.remove('hidden');
                    return;
                }

                const html = animes.slice(0, 5).map(anime => `
                                        <a href="/anime/${anime.mal_id || anime.id}" class="block p-3 hover:bg-gray-800 transition-colors border-b border-gray-800 last:border-0 text-left">
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-shrink-0 w-12 h-16 rounded-md overflow-hidden bg-gray-700">
                                                    <img src="${anime.images.jpg.image_url}" alt="${anime.title}" class="w-full h-full object-cover">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-semibold text-white truncate group-hover:text-blue-400">
                                                        ${anime.title}
                                                    </p>
                                                    <div class="flex items-center mt-1 text-xs text-gray-400 space-x-2">
                                                        <span class="bg-gray-700 px-1.5 py-0.5 rounded">${anime.type || 'TV'}</span>
                                                        <span>${anime.year || ''}</span>
                                                        ${anime.score ? `<span class="text-yellow-500 font-bold">★ ${anime.score.toFixed(1)}</span>` : ''}
                                                    </div>
                                                    <p class="text-xs text-gray-500 mt-1 line-clamp-1">
                                                        ${(anime.genres || []).map(g => g.name).join(', ')}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    `).join('');

                const viewAllLink = `
                                        <a href="{{ route('anime.search') }}?q=${encodeURIComponent(searchInput.value)}" class="block p-3 text-center text-sm font-bold text-blue-400 hover:text-blue-300 hover:bg-gray-800 transition-colors">
                                            Lihat semua hasil (${animes.length}+)
                                        </a>
                                    `;

                searchResults.innerHTML = html + viewAllLink;
                searchResults.classList.remove('hidden');
            }
        });
    </script>
@endsection