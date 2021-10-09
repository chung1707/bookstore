<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConst extends Model
{
    use HasFactory;
    Const TRANSACTION_CODE = 7;
    Const DEFAULT_PER_PAGE = 10;
}
