@extends('forntend.master')

@section('content')
<!-- ======================= Shop Style 1 ======================== -->
<section class="bg-cover" style="background:url({{ asset('/forntend/assets/img/banner-2.png')}}) no-repeat;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-left py-5 mt-3 mb-3">
                    <h1 class="ft-medium mb-3">Shop</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Shop Style 1 ======================== -->


<!-- ======================= Filter Wrap Style 1 ======================== -->
<section class="py-3 br-bottom br-top">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ============================= Filter Wrap ============================== -->


<!-- ======================= All Product List ======================== -->
<section class="middle">
    <div class="container">
        <div class="row">
            
            <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 p-xl-0">
                <div class="search-sidebar sm-sidebar border">
                    <div class="search-sidebar-body">
                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#pricing" data-toggle="collapse" aria-expanded="false" role="button">Pricing</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="pricing" data-parent="#pricing">
                                <div class="row">
                                    <div class="col-lg-6 pr-1">
                                        <div class="form-group pl-3">
                                            <input type="number" class="form-control" id="min" placeholder="Min">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pl-1">
                                        <div class="form-group pr-3">
                                            <input type="number" class="form-control" id="max" placeholder="Max">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group px-3">
                                            <button type="submit" id="amount" class="btn form-control">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#Categories" data-toggle="collapse" aria-expanded="false" role="button">Categories</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="Categories" data-parent="#Categories">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="inner_widget_link">
                                                <ul class="no-ul-list">
                                                    @foreach ($categories as $key=>$category )
                                                        <li>
                                                            <input type="radio" id="{{ $key }}" class="category_id" name="category_id"   value="{{ $category->id }}" 
                                                            @isset($_GET['category_id'])
                                                                @if ($category->id == $_GET['category_id'])
                                                                    checked
                                                                @endif
                                                            @endisset
                                                            >
                                                            <label for="{{ $key }}" class="checkbox-custom-label">{{ $category->name }}
                                                                <span>{{ App\Models\Product::where('category_id',$category->id)->count() }}</span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#brands" data-toggle="collapse" aria-expanded="false" role="button">Brands</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="brands" data-parent="#brands">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="inner_widget_link">
                                                <ul class="no-ul-list">
                                                    <li>
                                                        <input id="brands1" class="checkbox-custom" name="brands" type="radio">
                                                        <label for="brands1" class="checkbox-custom-label">Sumsung<span>142</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="brands2" class="checkbox-custom" name="brands" type="radio">
                                                        <label for="brands2" class="checkbox-custom-label">Apple<span>652</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="brands3" class="checkbox-custom" name="brands" type="radio">
                                                        <label for="brands3" class="checkbox-custom-label">Nike<span>232</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="brands4" class="checkbox-custom" name="brands" type="radio">
                                                        <label for="brands4" class="checkbox-custom-label">Reebok<span>192</span></label>
                                                    </li>
                                                    <li>
                                                        <input id="brands5" class="checkbox-custom" name="brands" type="radio">
                                                        <label for="brands5" class="checkbox-custom-label">Hawai<span>265</span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#colors" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Colors</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="colors" data-parent="#colors">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="text-left">
                                                @foreach ($colors as $key=>$color)
                                                    <div class=" form-check form-option form-check-inline mb-1">
                                                        <input  class="form-check-input color" type="radio" name="color_id" id="color{{ $key+1 }}" value="{{ $color->id }}"
                                                        @isset($_GET['color_id'])
                                                            @if ($color->id == $_GET['color_id'])
                                                                checked
                                                            @endif
                                                        @endisset
                                                        >
                                                        <label class="form-option-label rounded-circle" for="color{{ $key+1 }}"><span style="background:  {{ $color->color_code }}" class="form-option-color rounded-circle 
                                                            "></span></label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Single Option -->
                        <div class="single_search_boxed">
                            <div class="widget-boxed-header">
                                <h4><a href="#size" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Size</a></h4>
                            </div>
                            <div class="widget-boxed-body collapse show" id="size" data-parent="#size">
                                <div class="side-list no-border">
                                    <!-- Single Filter Card -->
                                    <div class="single_filter_card">
                                        <div class="card-body pt-0">
                                            <div class="text-left pb-0 pt-2">
                                                @foreach ($sizes as $k=>$size )
                                                <div class="form-check form-option form-check-inline mb-2">
                                                    <input type="radio" class="form-check-input size" name="size_id" id="s{{ $k }}" value="{{ $size->id }}"
                                                    @isset($_GET['size_id'])
                                                        @if ($size->id == $_GET['size_id'])
                                                            checked
                                                        @endif
                                                    @endisset
                                                    >
                                                    <label class="form-option-label" for="s{{ $k }}">{{ $size->size_name }} </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="border mb-3 mfliud">
                            <div class="row align-items-center py-2 m-0">
                                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                                    <h6 class="mb-0">Searched Products Found</h6>
                                </div>
                                
                                <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                                    <div class="filter_wraps d-flex align-items-center justify-content-end m-start">
                                        <div class="single_fitres mr-2 br-right">
                                            <select id="shortby" class="custom-select simple">
                                                <option >Default Sorting</option>
                                                <option value="1">Sort by Name: A To Z</option>
                                                <option value="2">Sort by price</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- row -->
                <div class="row align-items-center rows-products">
                    @foreach ($products as $product )
                        <!-- Single -->
                        <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                            <div class="product_grid card b-0">
                                <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                                <div class="badge bg-info text-dark position-absolute ft-bold ab-right text-lower"> <del>Off {{ $product->discount }} %</del> </div>
                                <div class="card-body p-0">
                                    <div class="shop_thumb position-relative">
                                        <a class="card-img-top d-block overflow-hidden" href="{{ route('product.details',$product->slug) }}"><img class="card-img-top" src="{{ asset('/uploads/products')}}/{{ App\Models\ProductImage::where('product_id',$product->id)->first()->product_image}}" alt="..."></a>
                                    </div>
                                </div>
                                <div class="card-footer b-0 p-0 pt-2 bg-white d-flex align-items-start justify-content-between">
                                    <div class="text-left">
                                        <div class="text-left">
                                            <div class="elso_titl"><span class="small">{{ $product->rel_to_brand->name }}</span></div>
                                            <h5 class="fs-md mb-0 lh-1 mb-1"><a href="{{ route('product.details',$product->slug) }}">{{ $product->product_title }}</a></h5>
                                            <div class="star-rating align-items-center d-flex justify-content-left mb-2 p-0">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="elis_rty"><span class="ft-bold text-dark fs-sm">BDT {{ $product->after_discount }}</span></div>
                                            <div class="elis_rty"><del class=" text-dark fs-sm">BDT {{ $product->price }}</del></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    
                </div>
                <!-- row -->
            </div>
        </div>
    </div>
</section>
        <!-- ======================= All Product List ======================== -->
@endsection

@section('footerscript')
    <script>
        $('#search_btn').click(function(){
            var search_input = $('#search_input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').val();
            var color_id = $('input[name="color_id"]:checked').val();
            var size_id = $('input[name="size_id"]:checked').val();
            var shortby = $('#shortby:slected').val();
            var link = "{{ route('shop') }}?"+"q="+search_input+"&mian="+min+"&max="+max+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&shortby="+shortby;
            window.location.href = link;
        });
        $('#amount').click(function(){
            var search_input = $('#search_input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').val();
            var color_id = $('input[name="color_id"]:checked').val();
            var size_id = $('input[name="size_id"]:checked').val();
            var link = "{{ route('shop') }}?"+"q="+search_input+"&min="+min+"&max="+max+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id;
            window.location.href = link;
        });
        $('.category_id').click(function(){
            var search_input = $('#search_input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').val();
            var color_id = $('input[name="color_id"]:checked').val();
            var size_id = $('input[name="size_id"]:checked').val();
            var link = "{{ route('shop') }}?"+"q="+search_input+"&min="+min+"&max="+max+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id;
            window.location.href = link;
        });
        $('.color').click(function(){
            var search_input = $('#search_input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').val();
            var color_id = $('input[name="color_id"]:checked').val();
            var size_id = $('input[name="size_id"]:checked').val();
            var link = "{{ route('shop') }}?"+"q="+search_input+"&min="+min+"&max="+max+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id;
            window.location.href = link;
        });
        $('.size').click(function(){
            var search_input = $('#search_input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').val();
            var color_id = $('input[name="color_id"]:checked').val();
            var size_id = $('input[name="size_id"]:checked').val();
            var link = "{{ route('shop') }}?"+"q="+search_input+"&min="+min+"&max="+max+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id;
            window.location.href = link;
        });
        $('#shortby').change(function(){
            var search_input = $('#search_input').val();
            var min = $('#min').val();
            var max = $('#max').val();
            var category_id = $('input[class="category_id"]:checked').val();
            var color_id = $('input[name="color_id"]:checked').val();
            var size_id = $('input[name="size_id"]:checked').val();
            var shortby = $('#shortby').val();
            var link = "{{ route('shop') }}?"+"q="+search_input+"&min="+min+"&max="+max+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&shortby="+shortby;
            window.location.href = link;
        });
    </script>
@endsection