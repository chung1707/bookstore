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
        $linkDelete = "/user_delete/";
        $admins = User::whereHas('role', function (Builder $query) {
            $query->where('name', '=', 'admin');
        })->where('id', '!=', auth()->user()->id)->orderBy('created_at', 'desc')->with('province', 'ward', 'district',)->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('admin.userManagement.list_admin')
        ->with('linkDelete', $linkDelete)
        ->with('admins', $admins);
    }
    public function userAccounts()
    {
        $linkDelete = "/user_delete/";
        $users = User::whereHas('role', function (Builder $query) {
            $query->where('name', '!=', 'admin');
        })->orderBy('created_at', 'desc')->with('province', 'ward', 'district',)->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('admin.userManagement.list_user')
        ->with('users', $users)
        ->with('linkDelete', $linkDelete);
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
        try{
            $user->delete();
            return response()->json(['status' => 201, 'name' =>$user->name]);
        }catch(\Exception $e){
            return response()->json(['status' => 401, 'error' =>$e]);
        }
    }
    public function showUser(User $user){
        $user->load('role');
        return view('admin.userManagement.account_details')->with('user', $user);
    }
}
