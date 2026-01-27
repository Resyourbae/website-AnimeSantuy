<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'anime_id',
        'title',
        'image_url',
        'type',
        'score',
        'year',
        'item_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
