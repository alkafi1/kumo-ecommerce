<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use Auth;

class CheckoutController extends Controller
{
    function checkout(){
        $upazilas = Upazila::all();
        $districts = District::all();
        $divisions = Division::all();
        $carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get() ;
        $carts_count = Cart::where('customer_id',Auth::guard('customerlogin')->id())->count() ;
        return view('forntend.checkout',[
            'carts' => $carts,
            'carts_count' => $carts_count,
            'upazilas' => $upazilas,
            'districts' => $districts,
            'divisions' => $divisions,
        ]);
    }

    function getdistrict(Request $request){
        $str =' <option value="">-- Select District --</option>';
        $districts = District::where('division_id',$request->division_id)->get();
        foreach($districts as $district){
            $str .=' <option value="'.$district->id.'">'.$district->name.'</option>';
        }
        echo $str;
    }
    function getupazila(Request $request){
        $str =' <option value="">-- Select Upazila --</option>';
        $upazilas = Upazila::where('district_id',$request->district_id)->get();
        foreach($upazilas as $upazila){
            $str .=' <option value="'.$upazila->id.'">'.$upazila->name.'</option>';
        }
        echo $str;
    }
}
