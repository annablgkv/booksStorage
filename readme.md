## Создание баз данных:
```bash
php artisan make:migration create_authors
php artisan make:migration create_books
php artisan make:migration create_genre
```

## Структура таблиц (поля в таблицах):
Они находятся в папке `C:\OSPanel\domains\books.ann\database\migrations`:
```php
public function up()
{
    Schema::create('authors', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->date('birth')->nullable();
        $table->date('death')->nullable();
    });
}

public function down()
{
    Schema::drop('authors');
}
```

```php
public function up()
{
    Schema::create('genre', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
    });
}

public function down()
{
    Schema::drop('genre');
}
```

```php
public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('id_author')->unique();
        $table->integer('id_genre')->unique();
        $table->string('name')->unique();
        $table->text('description')->nullable();
        $table->year('created_at')->nullable();
    });
}

public function down()
{
    Schema::drop('books');
}
```

Запуск миграций:
```bash
php artisan migrate
```


## Создание моделей
```bash
php artisan make:model Author
php artisan make:model Book
php artisan make:model Genre
```

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = "authors";
    public $timestamps = false;

    public function book()
    {
        return $this->hasMany('App\Book');
    }
}
```

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = "genre";
    public $timestamps = false;

    public function book()
    {
        return $this->hasMany('App\Book');
    }
}
```

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";    
    public $timestamps = false;

    public function author()
    {
        return $this->hasOne('App\Author');
    }

    public function genre()
    {
        return $this->hasOne('App\Genre');
    }
}
```

## Создание контроллера
```bash
php artisan make:controller BookController
php artisan make:controller AuthorController
php artisan make:controller GenreController
```

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Author;

class AuthorController extends Controller
{
    public function getAuthor() {
        $author = Author::all();
        return response()->json($author);
    }
}
```

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Book;

class BookController extends Controller
{
    public function getBook() {
        $book = Book::all();
        return response()->json($book);
    }
}
```

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Genre;

class GenreController extends Controller
{
    public function getGenre() {
        $genre = Genre::all();
        return response()->json($genre);
    }
}
```

## Создание api 
```php
<?php

Route::get('/authors', 'AuthorController@getAuthor');
Route::get('/books', 'BookController@getBook');
Route::get('/genre', 'GenreController@getGenre');
```

##

[ { "id": 1, "name": "Гоголь Николай Васильевич", "birth": "1809-03-20", "death": "1852-02-21" } ]
