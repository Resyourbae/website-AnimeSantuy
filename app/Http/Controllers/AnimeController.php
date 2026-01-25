<?php

namespace App\Http\Controllers;

use App\Services\AnimeApiService;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function index(AnimeApiService $anime)
    {
        // Parallel fetch ideal, but sequential for now is fine with cache
        $ongoing = $anime->getOngoingAnime(10);
        $popular = $anime->getPopularAnime(10);
        $completed = $anime->getCompletedAnime(10);

        return view('anime.index', [
            'ongoing' => $ongoing,
            'popular' => $popular,
            'completed' => $completed
        ]);
    }

    public function search(Request $request, AnimeApiService $anime)
    {
        $query = $request->get('q');
        $page = $request->get('page', 1);

        if (!$query && !$request->ajax()) {
            return redirect('/');
        }

        $data = $anime->searchAnime($query, $page);

        if ($request->ajax()) {
            return response()->json($data['data']);
        }

        return view('anime.search', [
            'animes' => $data['data'],
            'pagination' => $data['pagination'],
            'query' => $query
        ]);
    }

    public function show($id, AnimeApiService $anime)
    {
        $data = $anime->getFullAnime($id);
        $episodes = $anime->getAnimeEpisodes($id);
        return view('anime.show', ['anime' => $data, 'episodes' => $episodes]);
    }

    public function genre(AnimeApiService $anime)
    {
        $genres = $anime->getGenres();
        return view('genre.index', ['genres' => $genres]);
    }

    public function list(Request $request, AnimeApiService $anime)
    {
        $page = $request->get('page', 1);
        $data = $anime->getAnimeList($page);

        if ($request->ajax()) {
            return response()->json([
                'data' => $data['data'],
                'pagination' => $data['pagination']
            ]);
        }

        return view('list.index', ['animes' => $data['data'], 'pagination' => $data['pagination']]);
    }

    public function jadwal(AnimeApiService $anime)
    {
        $schedule = $anime->getAiringSchedule();
        return view('jadwal.index', ['schedule' => $schedule]);
    }

    public function showGenre($genre, Request $request, AnimeApiService $anime)
    {
        $page = $request->get('page', 1);
        $data = $anime->getAnimeByGenre($genre, $page);
        return view('genre.show', ['animes' => $data['data'], 'pagination' => $data['pagination'], 'genre' => $genre]);
    }
}
