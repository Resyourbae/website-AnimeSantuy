<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class AnimeApiService
{
    public function topAnime(){
        $base = rtrim(config('services.anime.url'), '/');
        return Http::get($base . '/top/anime')->json();
    }
}
