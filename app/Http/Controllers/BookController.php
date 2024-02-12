<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function showBooks() {
        try {
            $books = Book::all();
        }
        catch (Exception $exception) {
            return response()->json([
                'message' => 'Failed to retrieve books. Please try again later.'
            ], 500 );
        }
        
        return response()->json([
            'message' => 'Books retrieved successfully.',
            'results' => $books
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function showBook($id) {
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

    public function updateBook($id, Request $request) {
        $id = (int) $id;

        if ($id <= 0) {
            return response()->json([
                'message' => 'The id must be an integer number bigger than 0.'
            ], 400);
        }

        try {
            $book = Book::find($id);
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

    public function deleteBook($id) {
        try {
            $book = Book::find($id);
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
