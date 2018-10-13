<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function withAlbum()
    {
        return $this->belongsTo(Album::class);
    }
}
