<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Song;
use Illuminate\Http\Request;

class SongController extends Controller {
    public function postSong(Request $request) {
        $song = new Song();
        $song->title = $request->input('title');
        $song->path = $request->input('path');
        $song->save();

        $albumId = $request->input('albumId');

        $album = Album::find($albumId);
        $song->albums()->attach($album);

        $artistId = $request->input('artistId');

        $artist = Artist::find($artistId);
        $song->artists()->attach($artist);

        return response()->json(['song' => $song], 201);
    }

    // ! \\ IMPORTANT
    public function detachAlbum($songId, $albumId)
    {
        $song = Song::find($songId);
        $album = Album::find($albumId);

        $song->albums()->detach($album);

        return 'Success';
    }

    public function detachArtist($songId, $artistId)
    {
        $song = Song::find($songId);
        $artist = Artist::find($artistId);

        $song->artists()->detach($artist);

        return 'Success';
    }

    public function getSongs() {
        $songs = Song::with('albums')->with('artists')->get();
        $response = ['songs' => $songs];
        return response()->json($response, 200);
    }

    public function putSong(Request $request, $id) {}

    public function deleteSong($id) {}
}