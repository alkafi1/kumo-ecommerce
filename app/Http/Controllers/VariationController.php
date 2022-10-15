<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;

class VariationController extends Controller
{
    function variation()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.variation',[
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }
    function color_store(Request $request)
   {
    
        $request->validate([
            'color_name'=>'unique:colors|required',
        ]);
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at'=> Carbon::now(),
        ]);
        return back()->with('success','Color Add Successfully.');
   }

   function color_delete($color_id)
   {
        Color::find($color_id)->delete();
        return back()->with('success','Color Delete Successfully.');
   }
    function size_store(Request $request)
   {
    
        $request->validate([
            'size_name'=>'unique:sizes|required',
        ]);
        Size::insert([
            'size_name' => $request->size_name,
            'size_detail' => $request->size_detail,
            'created_at'=> Carbon::now(),
        ]);
        return back()->with('success','Size Add Successfully.');
   }
   function size_delete($size_id)
   {
        Size::find($size_id)->delete();
        return back()->with('success','Size Delete Successfully.');
   }
}
