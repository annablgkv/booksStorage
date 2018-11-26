<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Book;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    public function getBook() {
        $book = Book::all();
        return response()->json($book);
    }

    public function getOneBook(Request $request) {
        $temp = $request->all();
        $id = $temp['id'];

        $book = Book::find($id);
        return response()->json($book);
    }

    public function setBook(Request $request) {
        $temp = $request->all();

        $book = new Book();
        $book->id_author = $temp['author'];
        $book->name = $temp['name'];
        $book->id_genre = $temp['genre'];
        $book->description = $temp['desc'];
        $book->created_at = $temp['date'];
        $book->save();
    }
    public function updateBook(Request $request) {
        $temp = $request->all();

        DB::table('books')
            ->where('id', $temp['id'])
            ->update(
                [
                    'id_author' => $temp['id_author'],
                    'id_genre' => $temp['id_genre'],
                    'name' => $temp['name'],
                    'description' => $temp['description'],
                    'created_at' => $temp['created_at']
                ]
            );
    }
    public function deleteBook(Request $request) {
        $temp = $request->all();

        Book::where('id', $temp['id'])->delete();
    }
}
