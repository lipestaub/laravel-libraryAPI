<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function showGenres() {
        $genres = Genre::all();

        $encoded = json_encode($genres, JSON_UNESCAPED_UNICODE);

        return response($encoded);
    }

    public function showGenre(int $id) {
        $genre = Genre::find($id);

        $encoded = json_encode($genre, JSON_UNESCAPED_UNICODE);

        return response($encoded);
    }

    public function createGenre(Request $request) {
        $genre = Genre::create($request->all());

        $encoded = json_encode($genre, JSON_UNESCAPED_UNICODE);

        return response($encoded);
    }

    public function updateGenre(int $id, Request $request) {
        $genre = Genre::find($id);
        $genre->update($request->all());

        $encoded = json_encode($genre, JSON_UNESCAPED_UNICODE);

        return response($encoded);
    }
}
