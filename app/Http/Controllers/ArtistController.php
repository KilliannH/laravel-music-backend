<?php

namespace App\Http\Controllers;

use App\Song;
use App\Album;
use App\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller {
    public function postArtist(Request $request) {
        $artist = new Artist();
        $artist->name = $request->input('name');
        $artist->img_url = $request->input('img_url');
        $artist->save();
        return response()->json(['artist' => $artist], 201);
    }

    public function getArtists() {
        $artists = Artist::with('songs')->with('albums')->get();
        $response = ['artists' => $artists];
        return response()->json($response, 200);
    }

    public function getArtist($id) {
        $artist = Artist::with('songs')->with('albums')->find($id);
        $response = ['artist' => $artist];
        return response()->json($response, 200);
    }

    public function attachAlbums(Request $request, $id)
    {
        $artist = Artist::find($id);

        $albumId = $request->input('albumId');

        foreach($albumId as $i) {
            $album = Album::find($i);
            $artist->albums()->attach($album);
        }

        return 'Successfully attached';
    }

    public function detachAlbums(Request $request, $id)
    {
        $artist = Artist::find($id);

        $albumId = $request->input('albumId');

        foreach($albumId as $i) {
            $album = Album::find($i);
            $artist->albums()->detach($album);
        }

        return 'Successfully detached';
    }

    public function putArtist(Request $request, $id) {
        $artist = Artist::find($id);
        if(!$artist) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $artist->name = $request->input('name');
        $artist->img_url = $request->input('img_url');
        $artist->save();
        return response()->json(['artist' => $artist], 200);
    }

    public function deleteArtist($id) {
        $artist = Artist::find($id);
        if(!$artist) {
            return response()->json(['message' => 'Document not found'], 404);
        }

        $songId = [];

        foreach ($artist->songs as $song) {
            array_push($songId, $song->id);
        }

        //detach artist from song before delete, this delete the association on table as well.
        foreach ($songId as $id) {
            $song = Song::find($id);
            $song->artists()->detach($artist);
        }

        $albumId = [];

        foreach ($artist->albums as $album) {
            array_push($albumId, $album->id);
        }

        foreach ($albumId as $id) {
            $album = Album::find($id);
            $album->artists()->detach($artist);
        }

        $artist->delete();
        return response()->json(['message' => 'Artist deleted'], 200);
    }
}