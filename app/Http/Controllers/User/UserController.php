<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserInfosRequest;class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id','=',auth()->user()->id)->with('province','ward','district','orders')->first();
        return view('client.account')->with('user', $user);
    }

    public function updateInfos(UpdateUserInfosRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->province_id = $request->province_id;
        $user->district_id = $request->district_id;
        $user->ward_id = $request->ward_id;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->update();
    }

    public function updateAccount(ChangePasswordRequest $request){
        $currentUser = User::find(auth()->user()->id);
        if(Hash::check($request->password,$currentUser->password))
        {
            $currentUser->update(['password' => bcrypt($request->new_password)]);
            return response()->json(['result'=> 'Đổi mật khẩu thành công!','success' => true]);
        }
        return response()->json(['result'=>'Mật khẩu hiện tại của bạn không chính xác!', 'success' => false]);
    }

}
