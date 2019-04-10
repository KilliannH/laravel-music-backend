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

Route::get('/songs/{id}', [
    'uses' => 'SongController@getSong'
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

Route::get('/artists/{id}', [
    'uses' => 'ArtistController@getArtist'
]);

Route::post('/artists', [
    'uses' => 'ArtistController@postArtist'
]);

Route::put('/artists/{id}', [
    'uses' => 'ArtistController@putArtist'
]);

// detach
Route::put('/artists/{id}/detach/albums', [
    'uses' => 'ArtistController@detachAlbums'
]);

// attach
Route::put('/artists/{id}/attach/albums', [
    'uses' => 'ArtistController@attachAlbums'
]);

Route::delete('/artists/{id}', [
    'uses' => 'ArtistController@deleteArtist'
]);


// Album

Route::get('/albums', [
    'uses' => 'AlbumController@getAlbums'
]);

Route::get('/albums/{id}', [
    'uses' => 'AlbumController@getAlbum'
]);

Route::post('/albums', [
    'uses' => 'AlbumController@postAlbum'
]);

Route::put('/albums/{id}', [
    'uses' => 'AlbumController@putAlbum'
]);

// detach
Route::put('/albums/{id}/detach/artists', [
    'uses' => 'AlbumController@detachArtists'
]);

// attach
Route::put('/albums/{id}/attach/artists', [
    'uses' => 'AlbumController@attachArtists'
]);

Route::delete('/albums/{id}', [
    'uses' => 'AlbumController@deleteAlbum'
]);

// AUTH

Route::post('/users', [
    'uses' => 'UserController@signup'
]);

Route::post('/users/signin', [
    'uses' => 'UserController@signin'
]);