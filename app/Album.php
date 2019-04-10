<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public $timestamps = false;

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
