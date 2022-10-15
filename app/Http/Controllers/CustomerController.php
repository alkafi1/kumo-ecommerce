<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use App\Models\CustomerEmailVerify;
use Carbon\Carbon;
use App\Notifications\EmailVerifyNotification;
use Auth;
use Notification;

class CustomerController extends Controller
{
    function customer_reg()
    {
        return view('forntend.registration');
    }
    function customer_reg_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        CustomerLogin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);
        //email verify
        $cutsomer = CustomerLogin::where('email', $request->email)->firstOrFail();
        $delete__old = CustomerEmailVerify::where('customer_id', $cutsomer->id)->delete();
        $email_verify_info = CustomerEmailVerify::create([
            'customer_id' => $cutsomer->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);  
        Notification::send($cutsomer, new EmailVerifyNotification($email_verify_info));
        return redirect()->route('customer.login')->with('emailverify','Please Verify Email For Login.');

        // if(Auth::guard('customerlogin')->attempt(['email'=>$request->email,'password'=>$request->password])){
        //     return redirect('/')->with('success','Sign In Successfull.');
        // }
        // else{
        //     return back()->with('success','Email Or Password Invalid');
        // }
        // return redirect('/')->with('success','Sign Up Successfull.');
    }
    function customer_email_verify($token){
        $customer = CustomerEmailVerify::where('token',$token)->firstOrFail();
        $customer_id = CustomerLogin::find($customer->customer_id);
        $customer_id->update([
            'email_verified_at' => Carbon::now(),
        ]);
        
        $delete_old = CustomerEmailVerify::where('customer_id', $customer_id)->delete();
        // return $customer_id;
        // if(Auth::guard('customerlogin')->attempt(['email'=>$customer_id->email,'password'=>$customer_id->password])){
        //     return redirect('/')->with('success','Sign In Successfull.');
        // }
        // else{
        //     return back()->with('success','Email Or Password Invalid');
        // }
        return redirect()->route('customer.login')->with('passreset','Your Email Has Been verified.');
    }
    
    function customer_login()
    {
        return view('forntend.login');
    }
    function customer_login_check(Request $request)
    {

        $data = $request->all();
        
        if(Auth::guard('customerlogin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
            if(Auth::guard('customerlogin')->user()->email_verified_at == NUll){
                return back()->with('notverify','Please email verify.');
            }
            else{
                return redirect('/')->with('success','Sign In Successfull.');
            }
            
        }
        else{
            return back()->with('success','Email Or Password Invalid');
        }
    }
    function customer_logout()
    {
        Auth::guard('customerlogin')->logout();
        return redirect()->route('customer.login');
    }
}
