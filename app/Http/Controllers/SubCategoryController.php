<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;
use Carbon\Carbon;
use Image;

class SubCategoryController extends Controller
{
    //
    function index(){
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.subcategory.index',[
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    function trashed_subcategory()
    {
        $trshed_subcategories = SubCategory::onlyTrashed()->get();
        return view('admin.subcategory.trashed_subcategory',[
            'trshed_subcategories' => $trshed_subcategories,
        ]);
    }

    function subcategory_store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => ['required',],
            'image' => ['required','mimes:png,jpg']
        ]);
        $subcategory = SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $request->image,
            'added_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $image = $request->image;
        $extension = $image->getClientOriginalExtension();
        $image_name = $subcategory->id.'.'.$extension;
        Image::make($image)->save(public_path('/uploads/subcategory/').$image_name);
        $subcategory->update([
            'image' => $image_name,
        ]);
        return back()->with('succes','Add Sub Category Successfull.');  
    }

    function status($subactegory_id)
    {
        $subactegory = SubCategory::find($subactegory_id);
        if($subactegory->status ==0)
        {
            $subactegory->update([
                'status' => 1,
            ]);
            return back()->with('succes','Status Update Successfull.');  
        }
        else
        {
            $subactegory->update([
                'status' => 0,
            ]);
            return back()->with('succes','Status Update Successfull.'); 
        }
    }

    function subcategory_delete($subactegory_id)
    {
        SubCategory::find($subactegory_id)->delete();
        return back()->with('succes','Sub Category Delete Successfull.'); 
    }
    function subcategory_restore($subactegory_id)
    {
        SubCategory::onlyTrashed()->find($subactegory_id)->restore();
        return back()->with('succes','Sub Category Restore Successfull.'); 
    }
}
