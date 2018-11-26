<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Author;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function getAuthor() {
        $author = Author::all();
        return response()->json($author);
    }

    public function setAuthor(Request $request) {
        $temp = $request->all();

        $author = new Author();
        $author->name = $temp['name'];
        $author->birth = $temp['birth'];
        $author->death = $temp['death'];
        $author->save();
    }
    public function getOneAuthor(Request $request) {
        $temp = $request->all();
        $id = $temp['id'];

        $author = Author::find($id);
        return response()->json($author);
    }

    public function updateAuthor(Request $request) {
        $temp = $request->all();

        DB::table('authors')
            ->where('id', $temp['id'])
            ->update(
                [
                    'name' => $temp['name'],
                    'birth' => $temp['birth'],
                    'death' => $temp['death']
                ]
            );
    }

    public function deleteAuthor(Request $request) {
        $temp = $request->all();

        Author::where('id', $temp['id'])->delete();
    }
}
