<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Billing_Detail;
use App\Models\OrderProduct;
use App\Models\Cart;
use App\Models\Inventory;
use Carbon\Carbon;
use App\Mail\InvoiceSend;
use Auth;
use Mail;

class OrderController extends Controller
{
    //
    function order_store(Request $request){
        if($request->payment_method == 1){
            $order_id = Order::insertGetId([
                'customer_id' =>Auth::guard('customerlogin')->id(),
                'sub_total' => $request->sub_total,
                'discount' => $request->discount,
                'charge' => $request->charge,
                'total' => $request->total,
                'created_at' => Carbon::now(),
            ]);
            Billing_Detail::insert([
                'order_id' => $order_id,
                'customer_id' =>Auth::guard('customerlogin')->id(),
                'name' =>$request->name,
                'email' =>$request->email,
                'company' =>$request->company,
                'mobile' =>$request->mobile,
                'address' =>$request->address,
                'division_id' =>$request->division_id,
                'district_id' =>$request->district_id,
                'upazila_id' =>$request->upazila_id,
                'zip_code' =>$request->zip_code,
                'note' =>$request->note,
                'created_at' => Carbon::now(),
            ]);
            $carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
            foreach($carts as $cart){
                OrderProduct::insert([
                    'order_id' => $order_id,
                    'customer_id' =>Auth::guard('customerlogin')->id(),
                    'product_id' =>$cart->product_id,
                    'color_id' =>$cart->color_id,
                    'size_id' =>$cart->size_id,
                    'price' =>$cart->price,
                    'quantity' =>$cart->quantity,
                    'created_at' => Carbon::now(),
                ]);
                //smsSend
                
                $url = "http://66.45.237.70/api.php";
                $number=$request->mobile;
                $text="Thank you For Purchasing Our Product. You Total Order Cost".$request->total;
                $data= array(
                    'username'=>"YourID",
                    'password'=>"YourPasswd",
                    'number'=>"$number",
                    'message'=>"$text"
                    );
                $ch = curl_init(); // Initialize cURL
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $smsresult = curl_exec($ch);
                $p = explode("|",$smsresult);
                $sendstatus = $p[0];

                
                //mailSend
                Mail::to($request->email)->send(new InvoiceSend($order_id));
                // Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('product_quantity',$cart->quantity);
                // Cart::where('customer_id',Auth::guard('customerlogin')->id())->delete();
            }
            
            return redirect()->route('order.success')->with('success','Your order Complete!!!');
        }
        if($request->payment_method == 2){
            $data = $request->all();
            return view('ssl_pay',[
                'data' => $data,
            ]);
        }
        if($request->payment_method == 3){
            $data = $request->all();
            return view('stripe',[
                'data' => $data,
            ]);
        }
    }

    function order_success(){
        return view('forntend.order_success');
    }

    function review_store(Request $request){
        OrderProduct::where('customer_id',$request->customer_id)->where('product_id',$request->product_id)->update([
            'review' => $request->review,
            'star' => $request->star,
        ]);
        return back()->with('success','Your Review Submited.');
    }

}
