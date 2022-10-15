<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SubCategory;
use Auth;
use Image;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::simplePaginate(4);
        return view('admin.brands.index',[
            'categories' => $categories,
            'brands' => $brands,
            'subcategories' => $subcategories,
        ]);
    }
    function getsubcategoryid(Request $request)
    {
        $subcategory_infos = SubCategory::where('category_id',$request->category_id)->get();
        $str = '<option value="" >-- Select Subcategory --</option>';
        foreach($subcategory_infos as $subcategory_info){
            $str.= '<option value="'.$subcategory_info->id.'" >'.$subcategory_info->name.'</option>';
        }
        echo $str;
    }

    function brand_store(Request $request)
    {
        if($request->image != ''){
            $request->validate([
            'name'=>'unique:categories|required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'image' => 'required',
            'image'=>'mimes:jpg,png',
            'image'=>'file|max:1024',
            ]);
            $brand_id = Brand::insertGetId([
            'name'=> $request->name,
            'category_id'=> $request->category_id,
            'subcategory_id'=> $request->subcategory_id,
            'added_by'=> Auth::user()->id,
            'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $brand_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/brands/').$image_name)->resize(150,150);
            Brand::find($brand_id)->update([
                'image'=> $image_name,
            ]);
            return back()->with('success', 'Brand Added Successfully.');
        }
        else
        {
            // $request->validate([
            // 'name'=>'unique:categories|required',
            // 'category_id' => 'required',
            // ]);
            // $category_id = Brand::insertGetId([
            // 'name'=> $request->name,
            // 'category_id'=> $request->category_id,
            // 'added_by'=> Auth::user()->id,
            // 'created_at' => Carbon::now(),
            // ]);
            return back()->with('image', 'Image Required');
        }
    }

    function brand_delete($brand_id)
    {
        Brand::find($brand_id)->delete();
        return back()->with('success', 'Brand Delete Successfully.');
    }

    function brand_pdelete($pbrand_id)
    {
        $brand_info = Brand::onlyTrashed()->find($pbrand_id);
        $image_path = public_path('/uploads/brands/'.$brand_info->image);
        unlink($image_path);
        Brand::onlyTrashed()->find($pbrand_id)->forceDelete();
        return back()->with('success', 'Brand Permanently Delete.');
    }

     function trashed_brand()
     {
        $brands = Brand::onlyTrashed()->get();
        return view('admin.brands.trashed',[
            'brands' => $brands,
        ]);
     }

     function brand_restore($brand_id)
     {
        Brand::onlyTrashed()->find($brand_id)->restore();
        return redirect('/brand')->with('success', 'Brand Restore Successfully.');
     }


}
