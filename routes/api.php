<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Song

Route::get('/songs', [
    'uses' => 'SongController@getSongs'
]);

Route::post('/songs', [
    'uses' => 'SongController@postSong'
]);

Route::put('/songs/{id}', [
    'uses' => 'SongController@putSong'
]);

Route::delete('/songs/{id}', [
    'uses' => 'SongController@deleteSong'
]);

// detach artists, albums
Route::put('/songs/{id}/detach/artists', [
    'uses' => 'SongController@detachArtists'
]);

Route::put('/songs/{id}/detach/albums', [
    'uses' => 'SongController@detachAlbums'
]);

//attach
Route::put('/songs/{id}/attach/artists', [
    'uses' => 'SongController@attachArtists'
]);

Route::put('/songs/{id}/attach/albums', [
    'uses' => 'SongController@attachAlbums'
]);

// Artist

Route::get('/artists', [
    'uses' => 'ArtistController@getArtists'
]);

Route::post('/artists', [
    'uses' => 'ArtistController@postArtist'
]);

Route::put('/artists/{id}', [
    'uses' => 'ArtistController@putArtist'
]);

Route::delete('/artists/{id}', [
    'uses' => 'ArtistController@deleteArtist'
]);


// Album

Route::get('/albums', [
    'uses' => 'AlbumController@getAlbums'
]);

Route::post('/albums', [
    'uses' => 'AlbumController@postAlbum'
]);

Route::put('/albums/{id}', [
    'uses' => 'AlbumController@putAlbum'
]);

Route::delete('/albums/{id}', [
    'uses' => 'AlbumController@deleteAlbum'
]);
