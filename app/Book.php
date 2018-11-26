<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";    
    public $timestamps = false;

    public function author()
    {
        return $this->belongsToMany('App\Author');
    }

    public function genre()
    {
        return $this->belongsToMany('App\Genre');
    }
}
