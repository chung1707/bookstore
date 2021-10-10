<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use App\Models\DiscountCode;
use App\Models\Transporters;
use HoangPhi\VietnamMap\Models\Ward;
use Illuminate\Database\Eloquent\Model;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Province;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'note',
        'dispatch',
        'totalPrice',
        'transporter_id',
        'payment_methods',
        'discount_code_id',
        'phone_number',
        'province_id',
        'district_id',
        'ward_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function books(){
        return $this->belongsToMany(Book::class)->withPivot('quantity','price','discount');
    }
    public function discountCode(){
        return $this->belongsTo(DiscountCode::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function ward(){
        return $this->belongsTo(Ward::class);
    }
    public function transporter(){
        return $this->belongsTo(Transporters::class);
    }
}
