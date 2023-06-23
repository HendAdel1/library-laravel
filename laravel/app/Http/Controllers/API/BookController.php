<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;



class BookController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Book::with(['author', 'categories'])
            ->select('books.id', 'books.title', 'books.description', 'books.image', 'authors.name as authorname', 'books.created_at')
            ->leftJoin('authors', 'authors.id', '=', 'books.author_id')
            ->leftJoin('book_category', 'book_category.book_id', '=', 'books.id')
            ->leftJoin('categories', 'book_category.category_id', '=', 'categories.id')
            ->groupBy('books.id', 'books.title', 'books.description', 'books.image', 'authors.name', 'books.created_at')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'image' => $item->image,
                    'desc' => $item->description,
                    'author' => $item->authorname,
                    'category' => $item->categories->pluck('name')->toArray(),
                    'created_at' => $item->created_at
                ];
            })
            ->toArray();

        return $results;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'author_id' => 'required',
            'category_id' => 'required'


        ]);

        $book = Book::create($validatedData);

        $book->categories()->attach($request->category_id);

        return $book;
    }

    /**
     * Display the specified resource.
     */ //search , filteration ,orderby in the same api
    public function show(Request $request)
    {

        $books = $this->index();

        //search function
        function search($request , $books){
            $filtered = '';
            if($request->title)
            {
                $filtered = array_filter($books,function($book){
                    global $request;
                    return $book['title'] === $request->title;
                });

            }else{

                $filtered = array_filter($books,function($book){
                    global $request;
                    return $book['author'] === $request->author;
                });

            }
            return $filtered;
        }


        //filteration function
        function filterByCategory($books){
            $filtered = '';
            $filtered = array_filter($books,function($book){

                foreach($book['category']as $category){
                    global $request;
                    if($category == $request->category_filter){
                        return $book;
                    }
                }
            });
            return $filtered;
        }


        //orderby function
        function orderBy($request,$books){
            if($request['order_by'] == 'name')
            {
                usort($books, function($a, $b) {
                    return $a['title'] > $b['title'];
                });

            }else{

                usort($books, function($a, $b) {
                    return $a['created_at'] > $b['created_at'];
                });

            }
            return $books;
        }

        if (($request->title or $request->author) and $request->order_by and $request->category_filter) {
            $result = search($request,$books);
            $result = filterByCategory($result);
            $result = orderBy($request,$result);

            return $result;

        } else if (($request->title or $request->author) and $request->order_by) {
            $result = search($request,$books);
            $result = orderBy($request,$result);

            return $result;

        } else if (($request->title or $request->author) and $request->category_filter) {
            $result = search($request,$books);
            $result = filterByCategory($result);

            return $result;

        } else if ($request->order_by and $request->category_filter) {
            $result = filterByCategory($books);
            $result = orderBy($request,$result);

            return $result;

        } else if ($request->title or $request->author) {

            return search($request , $books);

        } else if ($request->order_by) {

            return orderBy($request,$books);

        } else if ($request->category_filter) {

            return filterByCategory($books);

        }

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

    public function restore(string $id)
    {

        $book = Book::withTrashed()->findOrFail($id);
        $book->restore();
    
        return response()->json(['message' => 'Book restored successfully']);

    }
}
