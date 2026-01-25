<?php

use App\Http\Controllers\AnimeController;
use Illuminate\Support\Facades\Route;
use App\Services\AnimeApiService;

Route::get('/', [AnimeController::class, 'index']);
Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');
Route::get('/genre', [AnimeController::class, 'genre'])->name('anime.genre');
Route::get('/genre/{genre}', [AnimeController::class, 'showGenre'])->name('anime.genre.show');
Route::get('/list', [AnimeController::class, 'list'])->name('anime.list');
Route::get('/search', [AnimeController::class, 'search'])->name('anime.search');
Route::get('/jadwal', [AnimeController::class, 'jadwal'])->name('anime.jadwal');
