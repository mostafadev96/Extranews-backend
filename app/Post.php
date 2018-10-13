<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    public function video()
    {
        return $this->belongsTo(VideoPost::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
