<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }
}
