<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider($provider = 'google'){
        return Socialite::driver($provider)->redirect();
    }

    public function handelProviderCallback($provider){

        try {
           $socialite_user =  Socialite::driver($provider)->user();
        }catch (\Exception $exception){
            return \redirect()->route('login');
        }


        $user = User::where('email','=', $socialite_user->getEmail())->first();
        if(!$user){
          $user = User::create([
            'name' => $socialite_user->getName(),
            'provider-name' => $provider,
            'avatar' => $socialite_user->getAvatar(),
            'email' => $socialite_user->getEmail(),
            'password' => Hash::make($socialite_user->getId()),
            'email_verified_at' => Carbon::now(),
        ]);
        }

        Auth::login($user,true);
//        auth()->login($user, $remember = true );
        alert()->success('ورود شما موفقیت آمیز بود', 'باتشکر')->persistent('حله');
        return Redirect::back();
    }



}
