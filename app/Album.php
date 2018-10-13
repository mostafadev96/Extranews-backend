<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function photos()
    {
        return $this->hasMany(Gallery::class);
    }
    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
