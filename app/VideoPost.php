<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPost extends Model
{
    public function post()
    {
        return $this->hasOne(Post::class);
    }
}
