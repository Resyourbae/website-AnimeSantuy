@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center space-y-4 mb-12">
                <h1
                    class="text-4xl md:text-5xl font-black bg-gradient-to-r from-green-400 to-emerald-600 bg-clip-text text-transparent">
                    Daftar Anime
                </h1>
                <p class="text-gray-300">
                    Temukan ribuan anime populer
                </p>
            </div>

            <!-- Anime Grid -->
            <div id="animeGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach ($animes as $anime)
                    <x-anime-card :anime="$anime" />
                @endforeach
            </div>

            <!-- Loader (Hidden by default) -->
            <div id="loadingIndicator" class="hidden mt-12 text-center">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-500"></div>
            </div>

            <!-- Load More / Pagination -->
            <div class="mt-12 flex justify-center space-x-4" id="paginationContainer">
                @if ($pagination['hasNextPage'])
                    <button id="loadMoreBtn" data-next-page="{{ $pagination['currentPage'] + 1 }}"
                        class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition-all shadow-lg shadow-blue-500/30 font-bold transform hover:scale-105 active:scale-95 flex items-center space-x-2">
                        <span>Load More</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn"
        class="fixed bottom-8 right-8 bg-blue-600 hover:bg-blue-500 text-white p-4 rounded-full shadow-2xl opacity-0 translate-y-10 transition-all duration-300 z-50 hover:shadow-blue-500/50 transform hover:scale-110 hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const animeGrid = document.getElementById('animeGrid');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const scrollToTopBtn = document.getElementById('scrollToTopBtn');

            // Scroll To Top Logic
            window.addEventListener('scroll', () => {
                if (window.scrollY > 500) {
                    scrollToTopBtn.classList.remove('hidden');
                    // Small delay to allow display:block to apply before changing opacity for transition
                    requestAnimationFrame(() => {
                        scrollToTopBtn.classList.remove('opacity-0', 'translate-y-10');
                    });
                } else {
                    scrollToTopBtn.classList.add('opacity-0', 'translate-y-10');
                    setTimeout(() => {
                        if (window.scrollY <= 500) scrollToTopBtn.classList.add('hidden');
                    }, 300);
                }
            });

            scrollToTopBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Load More Logic
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', async function () {
                    const nextPage = this.dataset.nextPage;

                    // Hide button, show loader
                    this.classList.add('hidden');
                    loadingIndicator.classList.remove('hidden');

                    try {
                        const response = await fetch(`{{ route('anime.list') }}?page=${nextPage}`, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        });

                        if (!response.ok) throw new Error('Network error');

                        const data = await response.json();

                        // Append new items
                        const newItemsHtml = data.data.map(anime => `
                                <a href="/anime/${anime.mal_id || anime.id || 0}" class="block anime-card group cursor-pointer">
                                    <div class="relative overflow-hidden rounded-xl bg-gray-800/50 backdrop-blur-sm border border-white/5 hover:border-purple-500/50 transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-purple-500/20">
                                        <div class="relative aspect-[3/4] overflow-hidden">
                                            <img src="${anime.images.jpg.image_url}" alt="${anime.title}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" loading="lazy">
                                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                            ${anime.score ? `
                                                <div class="absolute top-2 right-2 px-2 py-1 bg-black/60 backdrop-blur-md rounded text-xs font-bold text-yellow-400 flex items-center shadow-lg border border-white/10">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                    ${anime.score.toFixed(1)}
                                                </div>
                                            ` : ''}
                                        </div>
                                        <div class="p-3">
                                            <h3 class="text-gray-100 font-semibold text-sm line-clamp-2 mb-1 group-hover:text-purple-400 transition-colors">${anime.title}</h3>
                                            <div class="flex items-center justify-between text-xs text-gray-500">
                                                <span>${anime.type || 'TV'}</span>
                                                <span>${anime.episodes ? anime.episodes + ' eps' : '?'}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            `).join('');

                        animeGrid.insertAdjacentHTML('beforeend', newItemsHtml);

                        // Update button state
                        if (data.pagination.hasNextPage) {
                            this.dataset.nextPage = parseInt(nextPage) + 1;
                            this.classList.remove('hidden');
                        } else {
                            // No more pages
                            const endMessage = document.createElement('p');
                            endMessage.className = 'text-gray-500 mt-4 font-medium';
                            endMessage.textContent = 'Semua anime sudah ditampilkan';
                            document.getElementById('paginationContainer').appendChild(endMessage);
                        }

                    } catch (error) {
                        console.error('Error loading more:', error);
                        alert('Gagal memuat anime. Silakan coba lagi.');
                        this.classList.remove('hidden');
                    } finally {
                        loadingIndicator.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    </div>
    </div>
@endsection