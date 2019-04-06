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
        $artist = Artist::all();
        $response = ['artist' => $artist];
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
        $artist->delete();
        return response()->json(['message' => 'Artist deleted'], 200);
    }
}