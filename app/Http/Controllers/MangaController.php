<?php

namespace App\Http\Controllers;

use App\Services\AnimeApiService;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function index(Request $request, AnimeApiService $api)
    {
        $page = $request->get('page', 1);
        $search = $request->get('q');
        $category = $request->get('category', 'populer');
        $genres = $request->get('genres'); // This should be an array from multiple checkboxes

        // Base search params
        $params = [
            'page' => $page,
            'search' => $search,
            'genres' => $genres,
        ];

        // Handle Categories/Status/Sort
        switch ($category) {
            case 'terbaru':
                $params['sort'] = 'UPDATED_AT_DESC';
                break;
            case 'tamat':
                $params['status'] = 'FINISHED';
                $params['sort'] = 'POPULARITY_DESC';
                break;
            case 'populer':
            default:
                $params['sort'] = 'POPULARITY_DESC';
                break;
        }

        $data = $api->searchManga($params);

        if ($request->ajax()) {
            return response()->json([
                'data' => $data['data'],
                'pagination' => $data['pagination']
            ]);
        }

        return view('manga.index', [
            'mangas' => $data['data'],
            'pagination' => $data['pagination'],
            'search' => $search,
            'category' => $category,
            'selectedGenres' => (array)$genres
        ]);
    }

    public function show($id, AnimeApiService $api)
    {
        // Store previous URL for back navigation
        $previous = url()->previous();
        $currentHost = request()->getSchemeAndHttpHost();

        if (
            str_starts_with($previous, $currentHost) &&
            !str_contains($previous, '/read/') &&
            !str_contains($previous, '/manga/')
        ) {
            session(['back_url' => $previous]);
        }

        $manga = $api->getFullManga($id);

        return view('manga.show', [
            'manga' => $manga
        ]);
    }

    public function read($id, $chapter, AnimeApiService $api)
    {
        $manga = $api->getFullManga($id);

        return view('manga.read', [
            'manga' => $manga,
            'currentChapter' => $chapter
        ]);
    }
}
