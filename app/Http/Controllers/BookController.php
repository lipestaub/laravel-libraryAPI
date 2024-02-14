<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\FilterBooksRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Genre;
use Exception;

class BookController extends Controller
{
    public function showBooks(FilterBooksRequest $request) {
        $query = Book::query();

        if ($request->has('title')) {
            $query->where('title', $request->input('title'));
        }

        if ($request->has('start_date')) {
            $query->where('release_date', '>=', $request->input('start_date'));
        }

        if ($request->has('end_date')) {
            $query->where('release_date', '<=', $request->input('end_date'));
        }

        if ($request->has('genre')) {
            $query->where('genre_id', Genre::where('name', $request->input('genre'))->value('id'));
            $request->offsetUnset('genre');
        }

        if ($request->has('author')) {
            $query->where('author', $request->input('author'));
        }

        try {
            $books = $query->get();
        }
        catch (Exception $exception) {
            return response()->json([
                'message' => 'Failed to retrieve books. Please verify the parameters and try again.'
            ], 500);
        }

        if (count($books) === 0) {
            return response()->json([
                'message' => 'No books found matching the specified criteria.'
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'message' => 'Books retrieved successfully.',
            'results' => $books
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function showBook(int $id) {
        $id = (int) $id;

        if ($id <= 0) {
            return response()->json([
                'message' => 'The id must be an integer number bigger than 0.'
            ], 400);
        }

        try {
            $book = Book::find($id);
        }
        catch (Exception $exception) {
            return response()->json([
                'message' => 'Book not found.'
            ], 404);
        }

        if ($book === null) {
            return response()->json([
                'message' => 'Book not found.'
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'message' => 'Book retrieved successfully.',
            'results' => $book
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function createBook(CreateBookRequest $request) {
        try {
            $book = Book::create($request->all());
        }
        catch (Exception $exception) {
            return response()->json([
                'error' => 'Failed to create book. Please try again later.'
            ], 500);
        }

        return response()->json([
            'message' => 'Book created successfully.',
            'results' => $book
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function updateBook(int $id, UpdateBookRequest $request) {
        $id = (int) $id;

        if ($id <= 0) {
            return response()->json([
                'message' => 'The id must be an integer number bigger than 0.'
            ], 400);
        }

        try {
            $book = Book::find($id);
        }
        catch (Exception $exception) {
            return response()->json([
                'message' => 'Book not found.'
            ], 404);
        }

        if ($book === null) {
            return response()->json([
                'message' => 'Book not found.'
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        try {
            $book->update($request->all());
        }
        catch (Exception $exception) {
            return response()->json([
                'error' => 'Failed to update book. Please try again later.'
            ], 500);
        }

        return response()->json([
            'message' => 'Book updated successfully.',
            'results' => $book
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function deleteBook(int $id) {
        try {
            $book = Book::find($id);
        }
        catch (Exception $exception) {
            return response()->json([
                'message' => 'Book not found.'
            ], 404);
        }

        if ($book === null) {
            return response()->json([
                'message' => 'Book not found.'
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        try {
            $book->delete();
        }
        catch (Exception $exception) {
            return response()->json([
                'error' => 'Failed to delete book. Please try again later.'
            ], 500);
        }

        return response()->json([
            'message' => 'Book deleted successfully.',
            'results' => $book
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
