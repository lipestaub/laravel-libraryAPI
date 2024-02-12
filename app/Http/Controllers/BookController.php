<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function showBooks() {
        $books = Book::all();

        return response()->json([
            'message' => 'Books retrieved successfully.',
            'results' => $books
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function showBook(int $id) {
        $book = Book::find($id);

        return response()->json([
            'message' => 'Book retrieved successfully.',
            'results' => $book
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function createBook(Request $request) {
        $book = Book::create($request->all());

        return response()->json([
            'message' => 'Book created successfully.',
            'results' => $book
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function updateBook(int $id, Request $request) {
        $book = Book::find($id);
        $book->update($request->all());

        return response()->json([
            'message' => 'Book updated successfully.',
            'results' => $book
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function deleteBook(int $id) {
        $book = Book::find($id);
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully.',
            'results' => $book
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
