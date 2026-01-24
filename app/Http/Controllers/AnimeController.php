<?php

namespace App\Http\Controllers;

use App\Services\AnimeApiService;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function index(AnimeApiService $anime){
        $respon = $anime->topAnime();
        return view('anime.index',['animes' => $respon['data'] ?? []]);
    }
}
