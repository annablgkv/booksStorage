<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Genre;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller
{
    public function getGenre() {
        $genre = Genre::all();
        return response()->json($genre);
    }

    public function setGenre(Request $request) {
        $temp = $request->all();

        $genre = new Genre();
        $genre->name = $temp['name'];
        $genre->save();
    }
    public function getOneGenre(Request $request) {
        $temp = $request->all();
        $id = $temp['id'];

        $genre = Genre::find($id);
        return response()->json($genre);
    }
    public function updateGenre(Request $request) {
        $temp = $request->all();

        DB::table('genre')
            ->where('id', $temp['id'])
            ->update(
                [
                    'name' => $temp['name'],
                ]
            );
    }

    public function deleteGenre(Request $request) {
        $temp = $request->all();

        Genre::where('id', $temp['id'])->delete();
    }
}
