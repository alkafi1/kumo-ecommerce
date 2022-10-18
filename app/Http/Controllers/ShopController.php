<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    function shop(Request $request){
        $data = $request->all();
        $products = Product::where(function ($q) use ($data){
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined'){
                $q->where(function ($q) use ($data){
                    $q->where('product_title','like','%'.$data['q'].'%');
                    $q->orWhere('description','like','%'.$data['q'].'%');
                    $q->orWhere('long_description','like','%'.$data['q'].'%');
                });
            }
            if(!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined' || !empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined'){
                $q->whereBetween('after_discount',[$data['min'],$data['max']]);
                
            }  
            if(!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined'){
                $q->where('category_id',$data['category_id']);
            }
            if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                $q->whereHas('inventories', function ($q) use ($data){
                    if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined'){
                        $q->whereHas('rel_to_color', function ($q) use ($data){
                            $q->where('color_id',$data['color_id']);
                        });
                    }
                    if(!empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                        $q->whereHas('rel_to_size', function ($q) use ($data){
                            $q->where('size_id',$data['size_id']);
                        });
                    }
                });
            }
            if(!empty($data['shortby']) && $data['shortby'] != '' && $data['shortby'] != 'undefined') {
                if($data['shortby'] == 2){
                    $q->where(function ($q) use ($data){
                        $q->orderByDesc('after_discount');
                    });
                }
            }
            
        })->get();
        $categories = Category::all();
        $product_images = ProductImage::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('forntend.shop',[
            'products' => $products,
            'product_images' => $product_images,
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }
}
