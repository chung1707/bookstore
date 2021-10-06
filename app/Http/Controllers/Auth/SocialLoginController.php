<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function processLoginGoogle(){
        $googleUser = Socialite::driver('google')->stateless()->user();
        if(!$googleUser){
            return redirect('/login');
        }
        $systemUser = User::firstOrCreate(
            ['google_id'=>$googleUser->id],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' =>$googleUser->id
            ]
        );
        Auth::login($systemUser);
        Cart::firstOrCreate(['user_id' => $systemUser->id]);
        return redirect('/profile');
    }

    public function redirectFacebook(){
        return Socialite::driver('facebook')->redirect();

    }
    public function processFacebookLogin(){
        $facebookUser = Socialite::driver('facebook')->stateless()->user();
        if(!$facebookUser){
            return redirect('/login');
        }
        $systemUser = User::firstOrCreate(
            ['facebook_id'=> $facebookUser->id],
            [
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'facebook_id' =>$facebookUser->id
            ]
        );
        Auth::login($systemUser);
        Cart::firstOrCreate(['user_id' => $systemUser->id]);
        return redirect('/profile');
    }
}
