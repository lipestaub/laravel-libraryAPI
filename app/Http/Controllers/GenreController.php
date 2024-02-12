<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Exception;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function showGenres() {
        try {
            $genres = Genre::all();
        }
        catch (Exception $exception) {
            return response()->json([
                'message' => 'Failed to retrieve genres. Please try again later.'
            ], 500 );
        }

        return response()->json([
            'message' => 'Genres retrieved successfully.',
            'results' => $genres
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function showGenre($id) {
        $id = (int) $id;

        if ($id <= 0) {
            return response()->json([
                'message' => 'The id must be an integer number bigger than 0.'
            ], 400);
        }

        try {
            $genre = Genre::find($id);
        }
        catch (Exception $exception) {
            return response()->json([
                'message' => 'Genre not found.'
            ], 404);
        }

        return response()->json([
            'message' => 'Genre retrieved successfully.',
            'results' => $genre
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function createGenre(Request $request) {
        try {
            $genre = Genre::create($request->all());
        }
        catch (Exception $exception) {
            return response()->json([
                'error' => 'Failed to create genre. Please try again later.'
            ], 500);
        }

        return response()->json([
            'message' => 'Genre created successfully.',
            'results' => $genre
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function updateGenre($id, Request $request) {
        $id = (int) $id;

        if ($id <= 0) {
            return response()->json([
                'message' => 'Error: The id must be an integer number bigger than 0.'
            ], 400);
        }

        try {      
            $genre = Genre::find($id);
            $genre->update($request->all());
        }
        catch (Exception $exception) {
            return response()->json([
                'error' => 'Failed to update genre. Please try again later.'
            ], 500);
        }

        return response()->json([
            'message' => 'Genre updated successfully.',
            'results' => $genre
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
