<?php

namespace App\Http\Controllers;

use App\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller {
    public function postArtist(Request $request) {
        $artist = new Artist();
        $artist->name = $request->input('name');
        $artist->save();
        return response()->json(['artist' => $artist], 201);
    }

    public function getArtists() {
        $artists = Artist::with('songs')->get();
        $response = ['artists' => $artists];
        return response()->json($response, 200);
    }

    public function putArtist(Request $request, $id) {
        $artist = Artist::find($id);
        if(!$artist) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $artist->name = $request->input('name');
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

        $artist->delete();
        return response()->json(['message' => 'Artist deleted'], 200);
    }
}