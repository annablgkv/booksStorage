<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Genre;
use App\Book;
use App\Author;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function quest1() {
        // $auth = DB::table('authors')

        $res1 = DB::table('books')
            ->join('authors', 'books.id_author', '=', 'authors.id')
            ->select(DB::raw('count(books.id) as count'),'authors.name')
            ->groupBy('authors.name')
            ->get();

        return response()->json($res1);
    }
    public function quest2() {
        // $auth = DB::table('authors')

        $res2 = DB::table('books')
            ->join('authors', 'books.id_author', '=', 'authors.id')
            ->select('books.name','books.created_at')
            ->where('authors.name','like','Чехов%')
            ->orderBy('created_at','desc')
            ->get();

        return response()->json($res2);
    }
    public function quest3() {
        // $auth = DB::table('authors')

        $res3 = DB::table('books')
            ->join('authors', 'books.id_author', '=', 'authors.id')
            ->join('genre', 'books.id_genre', '=', 'genre.id')
            ->select('books.name as book','authors.name as author','genre.name as genre')
            ->get();

        return response()->json($res3);
    }
}