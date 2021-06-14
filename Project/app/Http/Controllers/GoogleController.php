<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $googleID = $user->id;
            $email = $user->email;
            
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser)
            {      
                Auth::login($finduser);    
            }
            else
            {
               $newUser = User::create([
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make(Str::random(12)),
                ]);
      
                Auth::login($newUser);
            }
                          
            return redirect()->intended('/');
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
