<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Thumbnail;
use App\Models\ImportBills;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;


    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function thumbnails(){
        return $this->hasMany(Thumbnail::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function carts(){
        return $this->belongsToMany(Cart::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
    public function import_bills(){
        return $this->belongsToMany(ImportBills::class);
    }
}
