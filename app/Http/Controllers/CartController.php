<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Coupon;
use Carbon\Carbon;
use Auth;

class CartController extends Controller
{
    function cart_store(Request $request)
    {
        $request->validate([
            'color_id' => 'required',
            'size_id' => 'required',
            'quantity' => 'required',
        ]);
        if(Auth::guard('customerlogin')->check()){
                if(Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first()->product_quantity > $request->quantity){

                if(Cart::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){

                    Cart::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
                    return back()->with('success','Product Hass Been Updated.');
                }
                else
                {
                    Cart::insert([
                        'customer_id' => Auth::guard('customerlogin')->id(),
                        'product_id' => $request->product_id,
                        'color_id' => $request->color_id,
                        'size_id' => $request->size_id,
                        'quantity' => $request->quantity,
                        'price' => $request->quantity * $request->price, 
                        'created_at' => Carbon::now(),
                    ]);
                    return back()->with('success','Product Add In Your Cart');
                }
            }
            else{
                return back()->with('success',' Product Stock Out');
            }
        }
        else{
            return redirect('/customer/login');
        }
        
        
        
        
           
    }
    function getSize(Request $request){
        $sizes = Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        $str = '';
        $i=1;
        foreach($sizes as $key=>$size){
            $str .= '<input class="form-check-input" type="radio" name="size_id" id="'. $key+$i .'" value="'. $size->size_id.'" >
            <label class="form-option-label" for="' .$key+$i .'">' .$size->rel_to_size->size_name.' </label>';
        }
        echo $str;
    }
    function cart_page(Request $request)
    {
        $carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        $coupon_name = $request->coupon_name;
        $discount = null;
        $type = null;
        $msg = null;
        if($coupon_name == ''){
            $discount = 0;
        }
        else{
                if(Coupon::where('coupon_name',$coupon_name)->where('status',1)->exists()){
                if(Coupon::where('coupon_name',$coupon_name)->first()->validity > Carbon::today()){

                    $discount = Coupon::where('coupon_name',$coupon_name)->first()->discount_amount;
                    $type = Coupon::where('coupon_name',$coupon_name)->first()->coupon_type;
                }
                else
                {
                    $discount = 0;
                    $msg = 'Coupon Code Has Been Expire!!!';
                }
                
            }
            else{
                $discount = 0;
                $msg ='Coupon Code Invalid';
            }
        }
        

        return view('forntend.cart',[
            'carts' => $carts,
            'discount' => $discount,
            'msg' => $msg,
            'type' => $type,
        ]);
    }
    function cart_delete($cart_id)
    {
        Cart::find($cart_id)->delete();
        return back()->with('success', 'Product Remove From Cart.');
    }
    function cart_update(Request $request)
    {
        foreach( $request->quantity as $cart_id=>$quantity){
            Cart::find($cart_id)->update([
                'quantity' =>$quantity,
            ]);
        }
        return back()->with('success','Cart Updated!!!');
    }
}
