<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use App\Models\DiscountCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function books(){
        return $this->belongsToMany(Book::class)->withPivot('quantity','price');
    }
    public function discountCode(){
        return $this->belongsTo(DiscountCode::class);
    }
}
