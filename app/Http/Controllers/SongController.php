<?php

namespace App\Http\Controllers;

use App\Album;
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

        return response()->json(['song' => $song], 201);
    }

    // ! \\ IMPORTANT
    public function detachAlbum(Song $song, $albumId)
    {
        $album = Album::find($albumId);

        $song->albums()->detach($album);

        return 'Success';
    }

    public function getSongs() {
        $songs = Song::with('albums')->get();
        $response = ['songs' => $songs];
        return response()->json($response, 200);
    }

    public function putSong(Request $request, $id) {}

    public function deleteSong($id) {}
}