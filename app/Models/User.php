<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Role;
use App\Models\Order;
use App\Models\Comment;
use App\Models\SaleBill;
use App\Models\AdminCart;
use App\Models\ImportBills;
use HoangPhi\VietnamMap\Models\Ward;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Province;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook_id',
        'google_id',
        'role_id',
        'vip_user',
        'province_id',
        "district_id",
        "ward_id",
        'address',
        "phone",
        "avatar",
        "blocked",
    ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function cart(){
        return $this->hasOne(Cart::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
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
    public function import_bills(){
        return $this->hasMany(ImportBills::class);
    }
    public function adminCart(){
        return $this->hasOne(AdminCart::class);
    }
    public function saleBills(){
        return $this->hasMany(SaleBill::class);
    }
}
