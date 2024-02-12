<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function showGenres() {
        $genres = Genre::all();

        return response()->json([
            'message' => 'Genres retrieved successfully.',
            'results' => $genres
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function showGenre(int $id) {
        $genre = Genre::find($id);

        return response()->json([
            'message' => 'Genre retrieved successfully.',
            'results' => $genre
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function createGenre(Request $request) {
        $genre = Genre::create($request->all());

        return response()->json([
            'message' => 'Genre created successfully.',
            'results' => $genre
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function updateGenre(int $id, Request $request) {
        $genre = Genre::find($id);
        $genre->update($request->all());

        return response()->json([
            'message' => 'Genre updated successfully.',
            'results' => $genre
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
