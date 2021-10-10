<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\AppConst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class UserManageController extends Controller
{
    public function adminAccounts()
    {
        $admins = User::whereHas('role', function (Builder $query) {
            $query->where('name', '=', 'admin');
        })->where('id', '!=', auth()->user()->id)->orderBy('created_at', 'desc')->with('province', 'ward', 'district',)->paginate(AppConst::DEFAULT_PER_PAGE);
        $total = User::count('id');
        return view('admin.userManagement.list_admin')
        ->with('total', $total)
        ->with('admins', $admins);
    }
    public function userAccounts()
    {
        $users = User::whereHas('role', function (Builder $query) {
            $query->where('name', '!=', 'admin');
        })->orderBy('created_at', 'desc')->with('province', 'ward', 'district',)->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('admin.userManagement.list_user')->with('users', $users);
    }
    public function blockUser(User $user){
        $user->blocked =true;
        $user->save();
    }
    public function unBlockUser(User $user){
        $user->blocked =false;
        $user->save();
    }
    public function deleteUser(User $user){
        $user->delete();
        return redirect()->back();
    }
    public function showUser(User $user){
        $user->load('role');
        return view('admin.userManagement.account_details')->with('user', $user);
    }
}
