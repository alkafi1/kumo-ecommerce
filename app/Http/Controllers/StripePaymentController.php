<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Order;
use App\Models\Billing_Detail;
use App\Models\OrderProduct;
use App\Models\Cart;
use App\Models\Inventory;
use Carbon\Carbon;
use App\Mail\InvoiceSend;
use Auth;
use Mail;
   
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
  
        // Session::flash('success', 'Payment successful!');
        
        //my code
            $data = session('data');
            $order_id = Order::insertGetId([
                'customer_id' =>Auth::guard('customerlogin')->id(),
                'sub_total' => $data['sub_total'],
                'discount' => $data['discount'],
                'charge' => $data['charge'],
                'total' => $data['total'],
                'created_at' => Carbon::now(),
            ]);
            Billing_Detail::insert([
                'order_id' => $order_id,
                'customer_id' =>Auth::guard('customerlogin')->id(),
                'name' =>$data['name'],
                'email' =>$data['email'],
                'company' =>$data['company'],
                'mobile' =>$data['mobile'],
                'address' =>$data['address'],
                'division_id' =>$data['division_id'],
                'district_id' =>$data['district_id'],
                'upazila_id' =>$data['upazila_id'],
                'zip_code' =>$data['zip_code'],
                'note' =>$data['note'],
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
            Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('product_quantity',$cart->quantity);
            Cart::where('customer_id',Auth::guard('customerlogin')->id())->delete();
            }
            return redirect()->route('order.success')->with('success','Your order Complete!!!');

        //end my code/
    }
}