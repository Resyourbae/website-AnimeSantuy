<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\MangaController;
use Illuminate\Support\Facades\Route;
use App\Services\AnimeApiService;

Route::get('/', [AnimeController::class, 'index']);
Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');
Route::get('/watch/{anime_id}/{episode}', [AnimeController::class, 'watch'])->name('anime.watch');
Route::get('/genre', [AnimeController::class, 'genre'])->name('anime.genre');
Route::get('/genre/{genre}', [AnimeController::class, 'showGenre'])->name('anime.genre.show');
Route::get('/list', [AnimeController::class, 'list'])->name('anime.list');
Route::get('/search', [AnimeController::class, 'search'])->name('anime.search');
Route::get('/jadwal', [AnimeController::class, 'jadwal'])->name('anime.jadwal');
Route::get('/mylist', [AnimeController::class, 'mylist'])->name('anime.mylist');

// Manga Routes
Route::get('/manga', [MangaController::class, 'index'])->name('manga.index');
Route::get('/manga/{id}', [MangaController::class, 'show'])->name('manga.show');
Route::get('/manga/{id}/read/{chapter}', [MangaController::class, 'read'])->name('manga.read');
