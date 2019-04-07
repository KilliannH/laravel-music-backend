<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
