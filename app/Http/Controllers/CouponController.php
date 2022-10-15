<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    
    function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index',[
            'coupons' => $coupons,
        ]);
    }

    function coupon_store(Request $request){
        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'coupon_type' => $request->coupon_type,
            'discount_amount' => $request->discount_amount,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'validity' => $request->validity,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function coupon_status($coupon_id){
        if($coupon_id==0){
                Coupon::find($coupon_id)->update([
                'status' => 1,
            ]);
            return back()->with('success','Coupon Active');
        }
        else
        {
            Coupon::find($coupon_id)->update([
                'status' => 1,
            ]);
            return back()->with('success','Coupon Deactive');
        }
        
    }

    function coupon_delete($coupon_id)
    {
        Coupon::find($coupon_id)->delete();
       return back()->with('success','Coupon Deleted!!!');
    }
}
