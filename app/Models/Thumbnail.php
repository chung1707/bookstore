<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thumbnail extends Model
{
    use HasFactory;
    public function book(){
        return $this->belongsTo(Book::class);
    }
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
