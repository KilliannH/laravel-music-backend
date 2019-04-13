<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Song;
use Illuminate\Http\Request;

class AlbumController extends Controller {
    public function postAlbum(Request $request) {
        $album = new Album();
        $album->title = $request->input('title');
        $album->img_url = $request->input('img_url');
        $album->save();

        $artistId = $request->input('artistId');

        foreach ($artistId as $i) {
            $artist = Artist::find($i);
            $album->artists()->attach($artist);
        }

        return response()->json(['album' => $album], 201);
    }

    public function getAlbums() {
        $albums = Album::with('songs')->with('artists')->get();
        $response = ['albums' => $albums];
        return response()->json($response, 200);
    }

    public function getAlbum($id) {
        $album = Album::with('songs')->with('artists')->find($id);
        $response = ['album' => $album];
        return response()->json($response, 200);
    }

    public function attachArtists(Request $request, $id)
    {
        $album = Album::find($id);

        $artistId = $request->input('artistId');

        foreach($artistId as $i) {
            $artist = Artist::find($i);
            $album->artists()->attach($artist);
        }

        return 'Successfully attached';
    }

    public function detachArtists(Request $request, $id)
    {
        $album = Album::find($id);

        $artistId = $request->input('artistId');

        foreach($artistId as $i) {
            $artist = Artist::find($i);
            $album->artists()->detach($artist);
        }

        return 'Successfully detached';
    }

    public function putAlbum(Request $request, $id) {
        $album = Album::find($id);
        if(!$album) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $album->title = $request->input('title');
        $album->img_url = $request->input('img_url');
        $album->save();
        return response()->json(['album' => $album], 200);
    }

    public function deleteAlbum($id) {
        $album = Album::find($id);
        if(!$album) {
            return response()->json(['message' => 'Document not found'], 404);
        }

        $songId = [];

        foreach ($album->songs as $song) {
            array_push($songId, $song->id);
        }

        foreach ($songId as $id) {
            $song = Song::find($id);
            $song->albums()->detach($album);
        }

        $artistId = [];

        foreach ($album->artists as $artist) {
            array_push($artistId, $artist->id);
        }

        foreach ($artistId as $id) {
            $artist = Artist::find($id);
            $artist->albums()->detach($album);
        }

        $album->delete();
        return response()->json(['message' => 'Album deleted'], 200);
    }
}