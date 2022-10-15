<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;
use Auth;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $categories = Category::all();
        return view('admin.category.index',[
            'categories' => $categories,
        ]);
    }

    function category_store(Request $request)
    {
        if($request->image){
            $request->validate([
            'name'=>'unique:categories|required',
            'image'=>'mimes:jpg,png',
            'image'=>'file|max:1024',
            ]);
            $category_id = Category::insertGetId([
            'name'=> $request->name,
            'added_by'=> Auth::user()->id,
            'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $category_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/categories/').$image_name)->resize(150,150);
            Category::find($category_id)->update([
                'image'=> $image_name,
            ]);
            return back()->with('success', 'Category Added Successfully.');
        }
        else
        {
            $request->validate([
            'name'=>'unique:categories|required',
            ]);
            $category_id = Category::insertGetId([
            'name'=> $request->name,
            'added_by'=> Auth::user()->id,
            'created_at' => Carbon::now(),
            ]);
            return back()->with('success', 'Category Added Successfully.');
        }
    }

    function category_delete($category_id)
    {
        $category_info = Category::find($category_id);
        if($category_info->image == 'default.png'){
            Category::find($category_id)->forceDelete();
            return back()->with('success', 'Category Trashed Successfully.');
        }
        else
        {
            $image_path = public_path('/uploads/categories/'.$category_info->image);
            unlink($image_path);
            Category::find($category_id)->forceDelete();
            return back()->with('success', 'Category Trashed Successfully.');
        }
        
    }
}
