<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //
    public function index(){
        //get all books and order them by their name and the last updated one
        $books = DB::table('books')->select(['title','image','description','']);
        return $books;
    }

    //
    public function create(){
        return "book created";
    }

    //
    public function edit(){
        return "book edited";
    }

    //
    public function delete(){
        return "book deleted";
    }

    //
    public function show(){
        //
    }

}
