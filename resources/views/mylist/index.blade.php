@extends('layouts.app')

@section('content')
    <div class="relative pt-24 pb-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl md:text-4xl font-black text-white border-l-4 border-blue-500 pl-4">
                    My List
                </h1>
                <span id="listCount" class="text-gray-400 bg-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                    0 Items
                </span>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="hidden flex-col items-center justify-center py-20 text-center">
                <div class="w-32 h-32 bg-gray-800 rounded-full flex items-center justify-center mb-6 animate-pulse">
                    <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Belum ada Anime di List kamu</h2>
                <p class="text-gray-400 mb-8 max-w-md mx-auto">
                    Jelajahi anime dan klik ikon hati <span class="inline-block text-red-500">❤️</span> untuk menambahkannya
                    ke daftar favoritmu.
                </p>
                <a href="{{ route('anime.list') }}"
                    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-bold transition-all transform hover:scale-105 shadow-lg shadow-blue-600/30">
                    Jelajahi Anime
                </a>
            </div>

            <!-- Grid Container -->
            <div id="listGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @auth
                    @forelse($favorites as $favorite)
                        <div class="block anime-card group cursor-pointer relative" id="fav-{{ $favorite->anime_id }}">
                            <div
                                class="relative overflow-hidden rounded-xl bg-gray-800/50 backdrop-blur-sm border border-white/5 hover:border-purple-500/50 transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-purple-500/20">
                                <!-- Image Container -->
                                <a href="/{{ $favorite->item_type }}/{{ $favorite->anime_id }}"
                                    class="block relative aspect-[3/4] overflow-hidden">
                                    <img src="{{ $favorite->image_url }}" alt="{{ $favorite->title }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                        loading="lazy">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                    @if($favorite->score)
                                        <div
                                            class="absolute top-2 right-2 px-2 py-1 bg-black/60 backdrop-blur-md rounded text-xs font-bold text-yellow-400 flex items-center shadow-lg border border-white/10">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            {{ number_format($favorite->score, 1) }}
                                        </div>
                                    @endif
                                </a>

                                <!-- Remove Button -->
                                <button
                                    onclick="toggleMyList({ id: '{{ $favorite->anime_id }}', title: '{{ addslashes($favorite->title) }}' }, '{{ $favorite->item_type }}')"
                                    class="absolute top-2 left-2 p-2 rounded-full bg-red-500/80 hover:bg-red-600 text-white backdrop-blur-sm transition-all active:scale-95 z-20 group/trash"
                                    title="Remove from list">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>

                                <!-- Content -->
                                <a href="/{{ $favorite->item_type }}/{{ $favorite->anime_id }}" class="block p-3">
                                    <h3
                                        class="text-gray-100 font-semibold text-sm line-clamp-2 mb-1 group-hover:text-purple-400 transition-colors">
                                        {{ $favorite->title }}
                                    </h3>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>{{ $favorite->type }}</span>
                                        <span>{{ $favorite->year }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <h2 class="text-2xl font-bold text-white mb-2">Belum ada Anime di List kamu</h2>
                            <p class="text-gray-400 mb-8 max-w-md mx-auto">
                                Jelajahi anime dan klik ikon hati <span class="inline-block text-red-500">❤️</span> untuk
                                menambahkannya.
                            </p>
                        </div>
                    @endforelse
                @else
                    <!-- For Guest, show empty state or redirect -->
                    <div class="col-span-full py-20 text-center">
                        <div class="w-32 h-32 bg-gray-800 rounded-full mx-auto flex items-center justify-center mb-6">
                            <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Login diperlukan</h2>
                        <p class="text-gray-400 mb-8 max-w-md mx-auto">
                            Kamu harus login terlebih dahulu untuk melihat dan mengelola My List.
                        </p>
                        <a href="{{ route('login') }}"
                            class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-bold transition-all shadow-lg shadow-blue-600/30">
                            Login Sekarang
                        </a>
                    </div>
                @endauth
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const IS_AUTHENTICATED = {{ Auth::check() ? 'true' : 'false' }};
            const listCount = document.getElementById('listCount');

            @auth
                        const count = {{ count($favorites) }};
                listCount.textContent = `${count} Items`;
            @else
                listCount.textContent = `0 Items`;
            @endauth
            });
    </script>
@endsection