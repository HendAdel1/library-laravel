<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAuthorRequest;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $authors = Author::all();
        $authdata = [];

        foreach ($authors as $author) {
            $num_books = $author->books()->count();
            $authdata[] = [
                'id' => $author->id,
                'name' => $author->name,
                'num_books' => $num_books
            ];
        }

        return response()->json($authdata);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        //
        $author = Author::create($request->all());
        return response()->json($author, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $author = Author::find($id);

        if ($author) {
            $num_books = $author->books()->count();

            return response()->json([
                'id' => $author->id,
                'name' => $author->name,
                'num_books' => $num_books
            ]);
        } else {
            return response()->json(['message' => 'Author not found.'], 404);
    }
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAuthorRequest $request, $id)
    {
        $author = Author::find($id);
     if ($author) {
     $request->validate([
     'name' => 'required',
     ]);
     $author->update($request->all());
     return response()->json($author);
     } else {
     return response()->json(['message' => 'Author not found.'], 404);
    }
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $author = Author::find($id);
     if ($author) {
     $author->delete();
     return response()->json(null, 204);
     } else {
     return response()->json(['message' => 'Author not found.'], 404);
    }
        //
    }
}
