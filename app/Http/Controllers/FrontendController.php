<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\Size;
use App\Models\Cart;
use App\Models\OrderProduct;
use Auth;

class FrontendController extends Controller
{
    function welcome()
    {
        return view('welcome');
    }
    function index()
    {
        $categories = Category::all();
        $products = Product::where('status',1)->get();
        $product_images = ProductImage::all();
        
        return view('forntend.index',[
            'categories' => $categories,
            'products' => $products,
            'product_images' => $product_images,
           
        ]);
    }
    
    function product_details($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $product_images = ProductImage::where('product_id',$product->id)->get();
        $available_colors = Inventory::where('product_id',$product->id)
            ->selectRaw('color_id, count(*) as total')
            ->groupBy('color_id')
            ->get();
        $available_sizes = Inventory::where('product_id',$product->id)
            ->selectRaw('size_id, count(*) as total')
            ->groupBy('size_id')
            ->get();;
        $inventories = Inventory::where('product_id',$product->id)->get();
        $reviews = OrderProduct::where('product_id',$product->id)->whereNotNull('review')->get();
        $total_review = $reviews->count();
        $total_star = $reviews->where('star')->sum('star');
        return view('forntend.product_details',[
            'product' => $product,
            'product_images' => $product_images,
            'inventories' => $inventories,
            'available_colors' => $available_colors,
            'available_sizes' => $available_sizes,
            'reviews' => $reviews,
            'total_review' => $total_review,
            'total_star' => $total_star,
        ]);
    }

    function about_us()
    {
        return view('forntend.about_us');
    }












    function dashboard()
    {
        $total_user = User::count();
        $total_category = Category::count();
        $total_brand = Brand::count();
        return view('dashboard',[
            'total_user' => $total_user,
            'total_category' => $total_category,
            'total_brand' => $total_brand,
        ]);
    }
}
