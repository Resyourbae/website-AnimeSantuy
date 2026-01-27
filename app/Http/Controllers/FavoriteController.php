<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = [];
        if (Auth::check()) {
            $favorites = Favorite::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('mylist.index', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'title' => 'required|string',
            'item_type' => 'required|string|in:anime,manga',
        ]);

        $userId = Auth::id();
        $itemId = $request->id;
        $itemType = $request->item_type;

        $favorite = Favorite::where('user_id', $userId)
            ->where('anime_id', $itemId)
            ->where('item_type', $itemType)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Berhasil menghapus dari My List'
            ]);
        } else {
            Favorite::create([
                'user_id' => $userId,
                'anime_id' => $itemId,
                'item_type' => $itemType,
                'title' => $request->title,
                'image_url' => $request->image_url,
                'type' => $request->type,
                'score' => $request->score,
                'year' => $request->year,
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Berhasil menambahkan ke My List'
            ]);
        }
    }
}
