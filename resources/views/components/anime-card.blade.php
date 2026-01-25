@props(['anime'])

<a href="{{ route('anime.show', $anime['mal_id'] ?? $anime['id'] ?? 0) }}"
    class="block anime-card group cursor-pointer relative">
    <div
        class="relative overflow-hidden rounded-xl bg-gray-800/50 backdrop-blur-sm border border-white/5 hover:border-purple-500/50 transition-all duration-300 transform hover:scale-105 hover:shadow-xl hover:shadow-purple-500/20">
        <!-- Image Container -->
        <div class="relative aspect-[3/4] overflow-hidden">
            <img src="{{ $anime['images']['jpg']['image_url'] }}" alt="{{ $anime['title'] }}"
                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                loading="lazy">
            <div
                class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>

            <!-- Score Badge -->
            @if(isset($anime['score']) && $anime['score'])
                <div
                    class="absolute top-2 right-2 px-2 py-1 bg-black/60 backdrop-blur-md rounded text-xs font-bold text-yellow-400 flex items-center shadow-lg border border-white/10">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    {{ number_format($anime['score'], 1) }}
                </div>
            @endif
        </div>

        <!-- Content -->
        <div class="p-3">
            <h3
                class="text-gray-100 font-semibold text-sm line-clamp-2 mb-1 group-hover:text-purple-400 transition-colors">
                {{ $anime['title'] }}
            </h3>
            <div class="flex items-center justify-between text-xs text-gray-500">
                <span>{{ $anime['type'] ?? 'TV' }}</span>
                <span>{{ $anime['episodes'] ?? '?' }}</span>
            </div>
        </div>
    </div>
</a>