<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller {
    public function postAlbum(Request $request) {
        $album = new Album();
        $album->title = $request->input('title');
        $album->img_url = $request->input('img_url');
        $album->save();
        return response()->json(['album' => $album], 201);
    }

    public function getAlbums() {
        $albums = Album::all();
        $response = ['albums' => $albums];
        return $response()->json($response, 200);
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
        $album->delete();
        return response()->json(['message' => 'Album deleted'], 200);
    }
}