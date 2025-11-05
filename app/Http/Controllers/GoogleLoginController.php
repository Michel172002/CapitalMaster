<?php

namespace App\Http\Controllers;

use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{

    public function redirectToGoogle()
    { 
       return Socialite::driver('google')->redirect(); 
    } 


    public function handleGoogleCallback()
    { 
       $googleUser = Socialite::driver('google')->user(); 
       
       $user = User::where('email', $googleUser->email)->first(); 
       if (!$user){ 
           $user = User::create([ 'name' => $googleUser ->name, 'email' => $googleUser ->email, 'password' => Hash::make(rand(100000, 999999))]); 
       } 

       $profileUser = ProfileUser::where('user_id', $user->id)->first();

       Auth::login($user);

       if (!$profileUser){
            return redirect(route('complete-profile'));
        }

       return redirect(route('dashboard')); 
   } 
}
