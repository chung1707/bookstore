<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index(){
        $totalPending = Order::where('pending', '=',true)->count();
        $totalProcessing = Order::where('processing', '=',true)->count();
        $totalUser = User::whereHas('role', function (Builder $query) {
            $query->where('name', '!=', 'admin');
        })->count();
        $totalBook = Book::count();
        return view('admin.dashboard')
        ->with('totalPending', $totalPending)
        ->with('totalProcessing', $totalProcessing)
        ->with('totalUser', $totalUser)
        ->with('totalBook', $totalBook);
    }
}
