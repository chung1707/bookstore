<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name','address','phone','email','supplier_fax','logo'];

    public function books(){
        return $this->hasMany(Book::class);
    }
}
