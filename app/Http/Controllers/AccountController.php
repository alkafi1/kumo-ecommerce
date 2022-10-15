<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Billing_Detail;
use App\Models\OrderProduct;
use App\Models\CustomerLogin;
use App\Models\CustomerPassReset;
use App\Notifications\PassResetNotification;
use Notification;
use Auth;
use PDF;
use Carbon\carbon;

class AccountController extends Controller
{
    //

    function customer_profile(){
        
        return view('forntend.profile');
    }
    function my_order(){
        $orders = Order::where('customer_id',Auth::guard('customerlogin')->id())->get();
        
        return view('forntend.my_order',[
            'orders' => $orders,
        ]);
    }
    
    function invoice_download($order_id){
        $order = Order::where('id',$order_id)->get();
        $billing_info = Billing_Detail::where('order_id',$order_id)->get();
        $order_products = OrderProduct::where('order_id',$order_id)->get();

        // return view('invoice.invoice_download',[
        //     'order' => $order,
        //     'billing_info' => $billing_info,
        //     'order_products' => $order_products,
        // ]);
        $data = [
            'order' => $order,
            'billing_info' => $billing_info,
            'order_products' => $order_products,
        ];
          
        $pdf = PDF::loadView('invoice.invoice_download', $data);
        
        return $pdf->stream('kumo-invoice.pdf');

    }

    function customer_pass_reset()
    {
        return view('customer_pass_reset');
    }

    function customer_pass_reset_req(Request $request)
    {
        $cutsomer = CustomerLogin::where('email', $request->email)->firstOrFail();
        $delete__old = CustomerPassReset::where('customer_id', $cutsomer->id)->delete();
        $pass_rest_info = CustomerPassReset::create([
            'customer_id' => $cutsomer->id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);  
        Notification::send($cutsomer, new PassResetNotification($pass_rest_info));
        return redirect()->route('customer.login')->with('passreset','Password Reset link Send Your Email.');
    }

    function customer_pass_reset_form($token){
        if(CustomerPassReset::where('token', $token)->exists()){
            return view('pass_req_form',[
                'token' => $token,
            ]);
        }
        else{
            abort(404);
        }
        
    }
    function customer_pass_reset_update(Request $request){
        $customer = CustomerPassReset::where('token', $request->token)->firstOrFail();
        $customer_id = CustomerLogin::find($customer->customer_id)->update([
            'password' => bcrypt($request->password),
        ]);
        
        $delete_old = CustomerPassReset::where('customer_id', $customer_id)->delete();
        return redirect()->route('customer.login')->with('passreset','Password Reset Successfully.');
    }




}
