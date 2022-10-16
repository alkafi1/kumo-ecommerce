<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use Auth;
class GithubController extends Controller
{
    //
    function github_redirect(){
        return Socialite::driver('github')->redirect();
        // return  view('forntend.login');
    }
    function github_callback(){
        $user = Socialite::driver('github')->user();
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
