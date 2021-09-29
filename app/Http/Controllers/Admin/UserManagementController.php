<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class UserManagementController extends Controller
{
    public function adminAccounts()
    {
        $admins = User::whereHas('role', function (Builder $query) {
            $query->where('name', '=', 'admin');
        })->where('id', '!=', auth()->user()->id)->orderBy('created_at', 'desc')->with('province', 'ward', 'district',)->paginate(10);
        return view('admin.userManagement.list_admin')->with('admins', $admins);
    }
    public function userAccounts()
    {
        $users = User::whereHas('role', function (Builder $query) {
            $query->where('name', '!=', 'admin');
        })->orderBy('created_at', 'desc')->with('province', 'ward', 'district',)->paginate(10);
        return view('admin.userManagement.list_user')->with('users', $users);
    }
}
