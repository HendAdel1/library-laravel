<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::select('title', 'image', 'description', 'author_id')->get();
        return $books;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'author_id' => 'required'
        ]);

        $book = Book::create($validatedData);

        return $book;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Book::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'string',
            'image' => 'string',
            'description' => 'string',
            'author_id' => 'exists:authors,id'
        ]);

        $book = Book::findOrFail($id);
        $book->update($validatedData);

        return $book;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
