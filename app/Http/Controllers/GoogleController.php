<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    function google_redirect(){
        return Socialite::driver('google')->redirect();
        // return  view('forntend.login');
    }
    function google_callback(){
        $user = Socialite::driver('google')->user();
        if(CustomerLogin::where('email',$user->getEmail())->exists()){
            if(Auth::guard('customerlogin')->attempt(['email' => $user->getEmail(),'password'=>'github'])){
                return redirect('/');
            }
        }
        else{
            CustomerLogin::insert([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' =>bcrypt('github'),
                'created_at'=> Carbon::now(),
            ]);
            if(Auth::guard('customerlogin')->attempt(['email' => $user->getEmail(),'password'=>'github'])){
                return redirect('/');
            }
        }
    }
}
