<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use Exception;

class GenreController extends Controller
{
    public function showGenres() {
        try {
            $genres = Genre::all();
        }
        catch (Exception $exception) {
            return response()->json([
                'message' => 'Failed to retrieve genres. Please try again later.'
            ], 500);
        }

        if (count($genres) === 0) {
            return response()->json([
                'message' => 'No genres found.'
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'message' => 'Genres retrieved successfully.',
            'results' => $genres
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function showGenre(int $id) {
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

        if ($genre === null) {
            return response()->json([
                'message' => 'Genre not found.'
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'message' => 'Genre retrieved successfully.',
            'results' => $genre
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function createGenre(CreateGenreRequest $request) {
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

    public function updateGenre(int $id, UpdateGenreRequest $request) {
        $id = (int) $id;

        if ($id <= 0) {
            return response()->json([
                'message' => 'Error: The id must be an integer number bigger than 0.'
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

        if ($genre === null) {
            return response()->json([
                'message' => 'Genre not found.'
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        try {      
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
