<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function showBooks() {
        $books = Book::all();

        return response($this->getFormattedResponse('Books retrieved successfully', $books));
    }

    public function showBook(int $id) {
        $book = Book::find($id);

        return response($this->getFormattedResponse('Book retrieved successfully', $book));
    }

    public function createBook(Request $request) {
        $book = Book::create($request->all());

        return response($this->getFormattedResponse('Book created successfully', $book));
    }

    public function updateBook(int $id, Request $request) {
        $book = Book::find($id);
        $book->update($request->all());

        return response($this->getFormattedResponse('Book updated successfully', $book));
    }

    public function removeBook(int $id) {
        $book = Book::find($id);
        $book->delete();

        return response($this->getFormattedResponse('Book deleted successfully', $book));
    }

    private function getFormattedResponse(string $message, mixed $data): string {
        return json_encode([
            'message' => $message,
            'results' => $data
        ], JSON_UNESCAPED_UNICODE);
    }
}
