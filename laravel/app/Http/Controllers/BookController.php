<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Category;


class BookController extends Controller
{
    //
    public function index(){
        //get all books and order them by their name and the last updated one
        $books = DB::table('books')->
        join('book_category','book_category.book_id','=','books.id')
        ->__select(['books.title','books.description','books.image','book_category'])
        ->groupBy(['books.title','books.description','books.image','book_category'])->get();
        // join('book_category','book_category.book_id','=','books.id')->
        // select(['books.title','books.image','books.description'])->get();
        return $books;
    }

    //
    public function create(){
        return "book created";
    }

    //
    public function edit($id){
        return "book edited";
    }

    //
    public function delete($id){
        return "book deleted";
    }

    //
    public function show($id){
        //
    }

}
