<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public $timestamps = false;

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }
}
