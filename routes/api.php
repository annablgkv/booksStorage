<?php

Route::get('/authors', 'AuthorController@getAuthor');
Route::get('/books', 'BookController@getBook');
Route::get('/genre', 'GenreController@getGenre');

Route::post('/getOneBook', 'BookController@getOneBook');
Route::post('/getOneGenre', 'GenreController@getOneGenre');
Route::post('/getOneAuthor', 'AuthorController@getOneAuthor');




Route::post('/createAuthor', 'AuthorController@setAuthor');
Route::post('/createGenre', 'GenreController@setGenre');
Route::post('/createBook', 'BookController@setBook');

Route::post('/updateAuthor', 'AuthorController@updateAuthor');
Route::post('/updateBook', 'BookController@updateBook');
Route::post('/updateGenre', 'GenreController@updateGenre');


Route::post('/deleteAuthor', 'AuthorController@deleteAuthor');
Route::post('/deleteBook', 'BookController@deleteBook');
Route::post('/deleteGenre', 'GenreController@deleteGenre');

Route::get('/quest1', 'QuestionController@quest1');
Route::get('/quest2', 'QuestionController@quest2');
Route::get('/quest3', 'QuestionController@quest3');





