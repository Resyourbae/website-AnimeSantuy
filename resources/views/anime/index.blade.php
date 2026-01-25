@extends('layouts.app')

@section('content')
    <!-- Static Ad Carousel -->
    <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-4">
        <div class="relative h-[300px] md:h-[400px] w-full overflow-hidden rounded-2xl shadow-2xl shadow-blue-500/20 group">
            <!-- Carousel content (same as before) -->
            <div id="carouselSlides" class="flex transition-transform duration-500 ease-out h-full">
                <!-- Slide 1 -->
                <div class="w-full flex-shrink-0 relative h-full">
                    <img src="{{ asset('assets/images/baner.jpeg') }}" alt="Ad 1" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent">
                        <div class="absolute bottom-0 left-0 p-8">
                            <h2 class="text-3xl font-bold text-white font-['Montserrat']">Masih tahap Pengembangan</h2>
                            <p class="text-gray-300">Website Anime Santuy Masih tahap Pengembangan</p>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="w-full flex-shrink-0 relative h-full">
                    <img src="{{ asset('assets/images/baner.jpeg') }}" alt="Ad 2" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent">
                        <div class="absolute bottom-0 left-0 p-8">
                            <h2 class="text-3xl font-bold text-white font-['Montserrat']">Masih tahap Pengembangan</h2>
                            <p class="text-gray-300">Website Anime Santuy Masih tahap Pengembangan</p>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="w-full flex-shrink-0 relative h-full">
                    <img src="{{ asset('assets/images/baner.jpeg') }}" alt="Ad 3" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent">
                        <div class="absolute bottom-0 left-0 p-8">
                            <h2 class="text-3xl font-bold text-white font-['Montserrat']">Masih tahap Pengembangan</h2>
                            <p class="text-gray-300">Website Anime Santuy Masih tahap Pengembangan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button onclick="moveSlide(-1)"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-blue-600 text-white p-2 rounded-full backdrop-blur-sm transition-colors opacity-0 group-hover:opacity-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button onclick="moveSlide(1)"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-blue-600 text-white p-2 rounded-full backdrop-blur-sm transition-colors opacity-0 group-hover:opacity-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Hero Section with Search -->
    <div class="relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="text-center space-y-6">
                <h1
                    class="text-5xl md:text-7xl font-black bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent">
                    Anime Terbaru
                </h1>
                <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto">
                    Update Anime Terbaru dan Terlengkap
                </p>

                <!-- Search Bar -->
                <div class="relative max-w-2xl mx-auto group z-50">
                    <form action="{{ route('anime.search') }}" method="GET" class="relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200">
                        </div>
                        <div class="relative">
                            <input type="text" name="q" id="homeSearchInput"
                                class="block w-full p-4 pl-12 pr-12 text-sm md:text-base text-gray-100 bg-gray-900 border border-gray-700 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 transition-all shadow-xl"
                                placeholder="Cari anime... (contoh: Naruto, One Piece)" autocomplete="off">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <!-- Loading Spinner -->
                            <div id="homeSearchLoading" class="absolute inset-y-0 right-0 flex items-center pr-4 hidden">
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
                    <div id="homeSearchResults"
                        class="absolute w-full mt-2 bg-gray-900/95 backdrop-blur-xl border border-gray-700 rounded-2xl shadow-2xl overflow-hidden hidden transition-all duration-300 z-50 max-h-[80vh] overflow-y-auto">
                        <!-- Results injected here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Sections -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-16">

        <!-- Update Terbaru (Ongoing) -->
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-white border-l-4 border-blue-500 pl-4">
                    Update Terbaru
                </h2>
                <a href="{{ route('anime.list') }}"
                    class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors">Lihat Semua →</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach ($ongoing as $anime)
                    <x-anime-card :anime="$anime" />
                @endforeach
            </div>
        </section>

        <!-- Anime Populer -->
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-white border-l-4 border-pink-500 pl-4">
                    Anime Populer
                </h2>
                <a href="{{ route('anime.list') }}"
                    class="text-pink-400 hover:text-pink-300 text-sm font-medium transition-colors">Lihat Semua →</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach ($popular as $anime)
                    <x-anime-card :anime="$anime" />
                @endforeach
            </div>
        </section>

        <!-- Anime Tamat (Completed) -->
        <section>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-white border-l-4 border-green-500 pl-4">
                    Anime Tamat
                </h2>
                <a href="{{ route('anime.list') }}"
                    class="text-green-400 hover:text-green-300 text-sm font-medium transition-colors">Lihat Semua →</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach ($completed as $anime)
                    <x-anime-card :anime="$anime" />
                @endforeach
            </div>
        </section>

    </div>

    <!-- Scripts -->
    <script>
        // Carousel Script
        let currentSlide = 0;
        const totalSlides = 3;
        function updateCarousel() {
            const container = document.getElementById('carouselSlides');
            if (container) container.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
        function moveSlide(direction) {
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            updateCarousel();
        }
        setInterval(() => moveSlide(1), 5000);

        // Live Search Script
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('homeSearchInput');
            const searchResults = document.getElementById('homeSearchResults');
            const searchLoading = document.getElementById('homeSearchLoading');
            let debounceTimer;

            const SEARCH_STORAGE_KEY = 'home_search_query';

            // Restore search query if exists
            const savedQuery = sessionStorage.getItem(SEARCH_STORAGE_KEY);
            if (savedQuery) {
                searchInput.value = savedQuery;
                // Optional: immediately fetch results if restored?
                // fetchResults(savedQuery); 
            }

            searchInput.addEventListener('input', function () {
                const query = this.value.trim();
                
                // Save to session storage
                sessionStorage.setItem(SEARCH_STORAGE_KEY, query);

                clearTimeout(debounceTimer);

                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    searchResults.innerHTML = '';
                    if(searchLoading) searchLoading.classList.add('hidden');
                    return;
                }

                if(searchLoading) searchLoading.classList.remove('hidden');

                debounceTimer = setTimeout(() => {
                    fetchResults(query);
                }, 400); // Wait 400ms after user stops typing
            });

            // Close results when clicking outside
            document.addEventListener('click', (e) => {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });

            async function fetchResults(query) {
                try {
                    // Show loading state if wanted
                    // searchResults.innerHTML = '<div class="p-4 text-center text-gray-400">Loading...</div>';
                    // searchResults.classList.remove('hidden');

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
                    if(searchLoading) searchLoading.classList.add('hidden');
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
                                    <a href="/anime/${anime.mal_id || anime.id}" class="block p-3 hover:bg-gray-800 transition-colors border-b border-gray-800 last:border-0">
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