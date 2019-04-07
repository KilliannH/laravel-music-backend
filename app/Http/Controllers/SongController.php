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

    // detach
    public function detachAlbums(Request $request, $id)
    {
        $song = Song::find($id);

        $albumId = $request->input('albumId');

        foreach($albumId as $i) {
            $album = Album::find($i);
            $song->albums()->detach($album);
        }

        return 'Successfully detached';
    }

    public function detachArtists(Request $request, $id)
    {
        $song = Song::find($id);

        $artistId = $request->input('artistId');

        foreach($artistId as $i) {
            $artist = Artist::find($i);
            $song->artists()->detach($artist);
        }

        return 'Successfully detached';
    }

    // attach
    public function attachAlbums(Request $request, $id)
    {
        $song = Song::find($id);

        $albumId = $request->input('albumId');

        foreach($albumId as $i) {
            $album = Album::find($i);
            $song->albums()->attach($album);
        }

        return 'Successfully attached';
    }

    public function attachArtists(Request $request, $id)
    {
        $song = Song::find($id);

        $artistId = $request->input('artistId');

        foreach($artistId as $i) {
            $artist = Artist::find($i);
            $song->artists()->attach($artist);
        }

        return 'Successfully attached';
    }

    public function getSongs() {
        $songs = Song::with('albums')->with('artists')->get();
        $response = ['songs' => $songs];
        return response()->json($response, 200);
    }

    public function putSong(Request $request, $id) {
        $song = Song::find($id)->with('artists')->get();
        if(!$song) {
            return response()->json(['message' => 'Document not found'], 404);
        }

        $song->title = $request->input('title');
        $song->path = $request->input('path');

        $song->save();
        return response()->json(['song' => $song], 200);
    }

    public function deleteSong($id) {
        $song = Song::find($id);
        if(!$song) {
            return response()->json(['message' => 'Document not found'], 404);
        }

        $albumId = [];

        foreach ($song->albums as $album) {
            array_push($albumId, $album->id);
        }

        foreach ($albumId as $id) {
            $album = Album::find($id);
            $album->songs()->detach($song);
        }

        $artistId = [];

        foreach ($song->artists as $artist) {
            array_push($artistId, $artist->id);
        }

        foreach ($artistId as $id) {
            $artist = Artist::find($id);
            $artist->songs()->detach($song);
        }

        $song->delete();
        return response()->json(['message' => 'Song deleted'], 200);
    }
}