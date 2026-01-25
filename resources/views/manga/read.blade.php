@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 to-black py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <div class="mb-4">
                <a href="#" onclick="history.back(); return false;"
                    class="inline-flex items-center text-gray-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Detail Manga
                </a>
            </div>

            <!-- Reader Container -->
            <div class="space-y-4">
                <!-- Chapter Info -->
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-6 border border-pink-500/20">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-2">{{ $manga['title'] }}</h1>
                            <p class="text-gray-400">Chapter {{ $currentChapter }}</p>
                        </div>

                        <!-- Chapter Navigation -->
                        <div class="flex gap-3">
                            @if($currentChapter > 1)
                                <a href="{{ route('manga.read', [$manga['id'], $currentChapter - 1]) }}"
                                    class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Previous
                                </a>
                            @endif

                            @php
                                $totalChapters = is_numeric($manga['chapters']) ? (int) $manga['chapters'] : 10;
                            @endphp

                            @if($currentChapter < $totalChapters)
                                <a href="{{ route('manga.read', [$manga['id'], $currentChapter + 1]) }}"
                                    class="px-6 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-lg transition-colors flex items-center gap-2">
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

                <!-- Reader Area (Placeholder) -->
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-8 border border-pink-500/20">
                    <div class="text-center space-y-6">
                        <svg class="w-24 h-24 mx-auto text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <div>
                            <h3 class="text-white text-2xl font-bold mb-2">Manga Reader Demo</h3>
                            <p class="text-gray-400 mb-4">{{ $manga['title'] }} - Chapter {{ $currentChapter }}</p>
                            <p class="text-gray-500 text-sm max-w-2xl mx-auto">
                                Ini adalah halaman demo reader. API tidak menyediakan halaman manga aktual.
                                Untuk membaca manga, silakan gunakan tombol di bawah untuk mencari di platform legal.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Reading Sources -->
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-6 border border-pink-500/20">
                    <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Baca di Sumber Legal
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        <!-- MangaDex -->
                        <a href="https://mangadex.org/search?q={{ urlencode($manga['title']) }}" target="_blank"
                            class="flex items-center justify-center gap-2 px-4 py-3 bg-orange-600 hover:bg-orange-500 text-white rounded-lg font-semibold transition-all shadow-lg shadow-orange-900/30">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z" />
                            </svg>
                            MangaDex
                        </a>

                        <!-- MangaPlus -->
                        <a href="https://mangaplus.shueisha.co.jp/search?query={{ urlencode($manga['title']) }}"
                            target="_blank"
                            class="flex items-center justify-center gap-2 px-4 py-3 bg-red-600 hover:bg-red-500 text-white rounded-lg font-semibold transition-all shadow-lg shadow-red-900/30">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Manga Plus
                        </a>

                        <!-- Google Search -->
                        <a href="https://www.google.com/search?q={{ urlencode($manga['title'] . ' Chapter ' . $currentChapter . ' read online') }}"
                            target="_blank"
                            class="flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition-all shadow-lg shadow-blue-900/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search Google
                        </a>
                    </div>

                    <p class="text-gray-500 text-xs mt-4 text-center">
                        *Gunakan sumber legal untuk mendukung kreator manga.
                    </p>
                </div>

                <!-- Chapter Selector -->
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-6 border border-pink-500/20">
                    <h3 class="text-white font-bold mb-4">Pilih Chapter</h3>
                    <select onchange="window.location.href = this.value"
                        class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg border border-gray-600 focus:border-pink-500 focus:ring-2 focus:ring-pink-500/50 outline-none">
                        @for($i = 1; $i <= $totalChapters; $i++)
                            <option value="{{ route('manga.read', [$manga['id'], $i]) }}" {{ $i == $currentChapter ? 'selected' : '' }}>
                                Chapter {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Bottom Navigation -->
                <div class="flex gap-3 justify-center">
                    @if($currentChapter > 1)
                        <a href="{{ route('manga.read', [$manga['id'], $currentChapter - 1]) }}"
                            class="px-8 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors font-semibold">
                            ← Previous Chapter
                        </a>
                    @endif

                    @if($currentChapter < $totalChapters)
                        <a href="{{ route('manga.read', [$manga['id'], $currentChapter + 1]) }}"
                            class="px-8 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-lg transition-colors font-semibold">
                            Next Chapter →
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection