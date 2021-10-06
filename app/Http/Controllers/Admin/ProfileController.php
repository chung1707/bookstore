<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserInfosRequest;

class ProfileController extends Controller
{
    public function index(){
        return view('admin.personal_page');
    }
    public function changePassword(){
        return view('admin.change_password');
    }
    public function update(UpdateUserInfosRequest $request,User $user){
            $user->fill($request->all());
            $user->update();
    }
    public function updatePassword(ChangePasswordRequest $request,){
        $currentUser = User::find(auth()->user()->id);
        if(Hash::check($request->password,$currentUser->password))
        {
            $currentUser->update(['password' => bcrypt($request->new_password)]);
            return response()->json(['result'=> 'Đổi mật khẩu thành công!','success' => true]);
        }
        return response()->json(['result'=>'Mật khẩu hiện tại của bạn không chính xác!', 'success' => false]);
    }
    public function updateAvatar(Request $request,User $user){
        if($request->avatar){
            $user->avatar = $request->avatar;
            $user->update();
        }
        return response()->json(['avatar'=>$request->avatar]);
    }
}
