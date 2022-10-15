<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\Inventory;
use Auth;
use Str;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    function index()
    {
        $products = Product::all();
        $product_imgs = ProductImage::first();
        return view('admin.products.index',[
            'products' => $products,
            'product_imgs' => $product_imgs,
        ]);
    }
    function product_add()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('admin.products.add_product',[
            'categories'=> $categories,
            'brands'=> $brands,
            'subcategories'=> $subcategories,
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
    function getbrandid(Request $request)
    {
        $brand_infos = Brand::where('subcategory_id',$request->subcategory_id)->get();
        $str = '<option value="" >-- Select Brand --</option>';
        foreach($brand_infos as $brand_info){
            $str.= '<option value="'.$brand_info->id.'" >'.$brand_info->name.'</option>';
        }
        echo $str;
    }

    function product_store(Request $request)
    {
        if(Product::where('category_id',$request->category_id)->where('brand_id',$request->brand_id)->where('product_title',$request->product_title)->exists()){
            return back()->with('error', 'Product Name Already exists.');
        }
        else{
            $request->validate([
            'product_title'=>'unique:products|required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'desc' => 'required',
            'long_desc' => 'required',
            'price' => 'required',
            
            ]);
            $product_id = Product::insertGetId([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'brand_id' => $request->brand_id,
                'product_title' => $request->product_title,
                'description' => $request->desc,
                'long_description' => $request->long_desc,
                'price' => $request->price,
                'discount' => $request->discount,
                'after_discount' => $request->price -($request->price * $request->discount/100),
                'sku' => substr($request->product_name,0,4).'-'. Str::random(5).rand(0,1000),
                'slug' => str_replace(' ', '-', Str::lower($request->product_name)).'-'.rand(0,100000),
                'added_by' => Auth::id(),
            ]);
            
            $sl=1;
            $product_img = $request->product_image;
            foreach($product_img as $image){
                $extension = $image->getClientOriginalExtension();
                $product_img_name = $request->product_title.'-'.$product_id.'-'.$sl.'.'.$extension;
                Image::make($image)->save(public_path('/uploads/products/'.$product_img_name))->resize(500,500);
                ProductImage::insert([
                    'product_id' => $product_id,
                    'product_image' => $product_img_name,
                    'added_by' => Auth::id(),
                    'created_at' => Carbon::now(),
                ]);
                $sl++;
            }
            return back()->with('success', 'Product Save Successfully.');
        }
    }

    function product_status($product_id)
    {
        $product_info = Product::find($product_id);
        if($product_info->status == '0'){
            Product::find($product_id)->update([
                'status' => 1,
            ]);
            return back()->with('succes','Product Now Active');
        }
        else{
            Product::find($product_id)->update([
                'status' => 0,
            ]);
            return back()->with('succes','Product Now Deactive');
        }
    }

    function product_inventory($product_id)
    {
        $product_info = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id',$product_id)->get();
        return view('admin.products.inventory',[
            'product_info' => $product_info,
            'colors' => $colors,
            'sizes' => $sizes,
            'inventories' => $inventories,
        ]);
    }

    function inventory_store(Request $request)
    {
        Inventory::insert([
            'product_name' => $request->product_name,
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'size_id' => $request->size_id,
            'product_quantity' => $request->product_quantity,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('succes','Inventory Added Succesfull.');
    }
    function inventory_status($inventory_id)
    {
        $inventory = Inventory::find($inventory_id);
        if($inventory->status ==0)
        {
            $inventory->update([
                'status' => 1,
            ]);
            return back()->with('succes','Inventory Active.');
        }
        else
        {
            $inaventory->update([
                'status' => 0,
            ]);
            return back()->with('succes','Inventory Deactive.');
        }
    }
}
