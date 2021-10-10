<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportBills extends Model
{
    use HasFactory,SoftDeletes;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function books(){
        return $this->belongsToMany(Book::class)->withPivot('quantity','price');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
