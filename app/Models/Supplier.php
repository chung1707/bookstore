<?php

namespace App\Models;

use App\Models\Book;
use App\Models\ImportBills;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','address','phone','email','supplier_fax','logo'];

    public function books(){
        return $this->hasMany(Book::class);
    }
    public function import_bills(){
        return $this->hasMany(ImportBills::class);
    }
}
