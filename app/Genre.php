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
