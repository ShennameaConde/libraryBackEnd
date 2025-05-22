<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

        public function index()
    {
       $books = Book ::get(); 
       return response()->json($books);
    } 


    public function store(Request $request)
{
$validated = $request->validate([
    'title' => 'required|string|max:255',
    'author' => 'required|string|max:255',
    'genre' => 'required|string|max:100',
    'available_copies' => 'required|integer|min:0',
    'year' => 'required|integer|min:0|max:' . date('Y'),  // e.g. valid year up to current year
    'description' => 'required|string',
]);


    $book = Book::create($validated);

    return response()->json($book, 201);
}


    public function show($id)
{
    $book = Book::find($id);

    if (!$book) {
        return response()->json(['message' => 'Book not found'], 404);
    }

    return response()->json($book);
}


    public function update(Request $request, $id)
{
    $book = Book::find($id);

    if (!$book) {
        return response()->json(['message' => 'Book not found'], 404);
    }

    $book->update($request->only(['title', 'author', 'genre', 'available_copies']));

    return response()->json($book);
}

    public function destroy($id)
{
    $book = Book::find($id);

    if (!$book) {
        return response()->json(['message' => 'Book not found'], 404);
    }

    $book->delete();

    return response()->json(['message' => 'Book deleted successfully']);
}

}
