<?php

use App\Http\Controllers\AnimeController;
use Illuminate\Support\Facades\Route;
use App\Services\AnimeApiService;

Route::get('/', [AnimeController::class, 'index']);

Route::get('/test-jikan', function (AnimeApiService $anime){
    return $anime->topAnime();
});

Route::get('/dump-anime-url', function(){
    return [
        'config_url' => config('services.anime.url'),
        'env_value' => env('ANIME_API_URL')
    ];
});

Route::get('/debug-http', function(){
    $url = config('services.anime.url') . '/top/anime';
    $r = \Illuminate\Support\Facades\Http::get($url);
    return [
        'url' => $url,
        'status' => $r->status(),
        'body_start' => substr($r->body(), 0, 200)
    ];
});