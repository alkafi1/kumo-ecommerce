@extends('forntend.master')
@section('content')
<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
    <div class="container">
        <div class="row">
            <div class="colxl-12 col-lg-12 col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Product Detail ======================== -->
<section class="middle">
    <div class="container">
        <div class="row justify-content-between">
        
            <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
                <div class="quick_view_slide">
                    @foreach ($product_images as $product_image )
                    <div class="single_view_slide">
                        
                            <a href="assets/img/product/4.jpg" data-lightbox="roadtrip" class="d-block mb-4"><img src="{{ asset('/uploads/products') }}/{{ $product_image->product_image }}" class="img-fluid rounded" alt="" /></a>
                       
                    </div>
                     @endforeach
                </div>
            </div>
            
            <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
                <div class="prd_details pl-3">
                    
                    <div class="prt_01 mb-1"><span class="text-light bg-info rounded px-2 py-1">{{ $product->rel_to_brand->name }}</span></div>
                    <div class="prt_02 mb-3">
                        <h2 class="ft-bold mb-1">{{ $product->product_title }}</h2>
                        <div class="text-left">
                            <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                @if($total_review == 0)
                                     <span class="small">(0 Reviews)</span>
                                @else
                                    @for($i = 1; $i < round($total_star/$total_review); $i++)
                                    <i class="fas fa-star filled"></i>
                                    @endfor
                                    <span class="small">({{ $total_review }} Reviews)</span>
                                @endif
                                
                            </div>
                            <div class="elis_rty">
                                <span class="ft-medium text-muted line-through fs-md mr-2">
                                    BDT {{ $product->price }}
                                </span>
                                <span class="ft-bold theme-cl fs-lg mr-2">BDT {{ $product->after_discount }}</span>
                                @php
                                    $price = $product->after_discount;
                                @endphp
                            </div>
                        </div>
                    </div>
                    
                    <div class="prt_03 mb-4">
                        <p>{{ $product->description }}</p>
                    </div>
                    <form action="{{ route('cart.store') }}" method="post">
                        @csrf
                        @php
                            $product_id = $product->id;
                        @endphp
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="prt_04 mb-2">
                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Color:</p>
                        <div class="text-left">
                           @foreach ($available_colors as $key=>$available_color)
                               <div class=" form-check form-option form-check-inline mb-1">
                                <input class=" color_id form-check-input" type="radio" name="color_id" id="color{{ $key+1 }}" value="{{ $available_color->rel_to_color->id }}">
                                <label class="form-option-label rounded-circle" for="color{{ $key+1 }}"><span style="background:  {{ $available_color->rel_to_color->color_code }}" class="form-option-color rounded-circle "></span></label>
                            </div>
                           @endforeach
                        </div>
                    </div>
                    
                    <div class="prt_04 mb-4">
                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Size:</p>
                        
                        <div class="text-left pb-0 pt-2" >
                            <div class="form-check size-option form-option form-check-inline mb-2 " id="size">
                                {{--  <input class="form-check-input" type="radio" name="size_id" id="" checked="" value="">
                                <label class="form-option-label" for=""></label>  --}}
                            </div>
                        </div>
                    </div>
                    <div class="prt_04 mb-4">
                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Price:</p>
                        
                        <div class="text-left pb-0 pt-2" >
                            <div class="form-check size-option form-option form-check-inline mb-2 ">
                                <span class="ft-bold theme-cl fs-lg mr-2 price">BDT {{ $product->after_discount }}</span> 
                                <input type="hidden" name="price" value="{{ $product->after_discount }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="prt_05 mb-4">
                        <div class="form-row mb-7">
                            <div class="col-12 col-lg">
                                {{--  <!-- Quantity -->
                                 <button type="button" class="btn input_number_decrement">
                                    <i class="ti-minus"></i>
                                </button>
                                <input class="form-control" type="number" name="quantity" id="" placeholder="Quantity">
                                <button type="button" class="btn input_number_increment">
                                    <i class="ti-plus"></i>
                                </button>  --}}
                                
                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" required>
                                
                            </div>
                            <div class="col-12 col-lg">
                                <!-- Submit -->
                                    <button type="submit" class="btn btn-block custom-height bg-dark mb-2">
                                        <i class="lni lni-shopping-basket mr-2"></i>Add to Cart 
                                    </button>
                            </div>
                            </form>
                            <div class="col-12 col-lg-auto">
                                <!-- Wishlist -->
                                <button class="btn custom-height btn-default btn-block mb-2 text-dark" data-toggle="button">
                                    <i class="lni lni-heart mr-2"></i>Wishlist
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="prt_06">
                        <p class="mb-0 d-flex align-items-center">
                            <span class="mr-4">Share:</span>
                            <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="#!">
                            <i class="fab fa-twitter position-absolute"></i>
                            </a>
                            <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted mr-2" href="#!">
                            <i class="fab fa-facebook-f position-absolute"></i>
                            </a>
                            <a class="d-inline-flex align-items-center justify-content-center p-3 gray circle fs-sm text-muted" href="#!">
                            <i class="fab fa-pinterest-p position-absolute"></i>
                            </a>
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Product Detail End ======================== -->

<!-- ======================= Product Description ======================= -->
<section class="middle">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12">
                <ul class="nav nav-tabs b-0 d-flex align-items-center justify-content-center simple_tab_links mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="description-tab" href="#description" data-toggle="tab" role="tab" aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#information" id="information-tab" data-toggle="tab" role="tab" aria-controls="information" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#reviews" id="reviews-tab" data-toggle="tab" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                    </li>
                </ul>
                
                <div class="tab-content" id="myTabContent">
                    
                    <!-- Description Content -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <div class="description_info">
                            <p class="p-0 mb-2">{{ $product->long_description }}</p>
                        </div>
                    </div>
                    
                    <!-- Additional Content -->
                    <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                        <div class="additionals">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="ft-medium text-dark">ID</th>
                                        <td>#1253458</td>
                                    </tr>
                                    <tr>
                                        <th class="ft-medium text-dark">SKU</th>
                                        <td>KUM125896</td>
                                    </tr>
                                    <tr>
                                        <th class="ft-medium text-dark">Color</th>
                                        <td>Sky Blue</td>
                                    </tr>
                                    <tr>
                                        <th class="ft-medium text-dark">Size</th>
                                        <td>Xl, 42</td>
                                    </tr>
                                    <tr>
                                        <th class="ft-medium text-dark">Weight</th>
                                        <td>450 Gr</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Reviews Content -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="reviews_info">
                            
                            @forelse ($reviews as $review )
                                <div class="single_rev d-flex align-items-start br-bottom py-3">
                                    <div class="single_rev_thumb">
                                        <img src="assets/img/team-1.jpg" class="img-fluid circle" width="90" alt="imag" />
                                    </div>
                                    <div class="single_rev_caption d-flex align-items-start pl-3">
                                        <div class="single_capt_left">
                                            <h5 class="mb-0 fs-md ft-medium lh-1">{{ $review->rel_to_customer->name }}</h5>
                                            <span class="small">{{ $review->updated_at->format('d/m/y') }}</span>
                                            <div class="star-rating align-items-center mt-3 d-flex justify-content-left mb-1 p-0">
                                                @for($i = 1; $i < $review->star; $i++)
                                                    <i class="fas fa-star filled"></i>
                                                @endfor
                                            </div>
                                            <p>{{ $review->review }}</p>
                                           
                                        </div>
                                    </div>
                                </div>
                            @empty
                                
                            @endforelse
                            
                        </div>
                        @auth('customerlogin')
                            @if(App\Models\OrderProduct::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$product->id)->exists())
                                @if(App\Models\OrderProduct::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$product->id)->whereNull('review')->exists())
                                    <div class="reviews_rate">
                                        <form class="row" action="{{ route('review.store') }}" method="POST">
                                            @csrf
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <h4>Submit Rating</h4>
                                            </div>
                                            
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="revie_stars d-flex align-items-center justify-content-between px-2 py-2 gray rounded mb-2 mt-1">
                                                    <div class="srt_013">
                                                        <div class="submit-rating">
                                                            <input id="star-5" type="radio" name="rating" value="5" class="star" />
                                                            <label for="star-5" title="5 stars">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-4" type="radio" name="rating" value="4" class="star" />
                                                            <label for="star-4" title="4 stars">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-3" type="radio" name="rating" value="3" class="star" />
                                                            <label for="star-3" title="3 stars">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-2" type="radio" name="rating" value="2" class="star" />
                                                            <label for="star-2" title="2 stars">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                            <input id="star-1" type="radio" name="rating" value="1" class="star" />
                                                            <label for="star-1" title="1 star">
                                                            <i class="active fa fa-star" aria-hidden="true"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="srt_014">
                                                        <input type="hidden" name="star" id="starinput" >
                                                        <h6 class="mb-0" id="starv"> Star</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="medium text-dark ft-medium">Full Name</label>
                                                    <input type="hidden" name="customer_id" value="{{ Auth::guard('customerlogin')->id() }}"/>
                                                    
                                                    <input type="text" name="name" readonly class="form-control" value="{{ Auth::guard('customerlogin')->user()->name }}"/>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="medium text-dark ft-medium">Email Address</label>
                                                    <input type="text" readonly name="email" class="form-control" value="{{ Auth::guard('customerlogin')->user()->email }}"/>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="medium text-dark ft-medium">Description</label>
                                                    <textarea name="review" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group m-0">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                                                    <button class="btn btn-white stretched-link hover-black" type="submit">Submit Review <i class="lni lni-arrow-right"></i></button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                @else
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="revie_stars d-flex align-items-center justify-content-between px-2 py-2 gray rounded mb-2 mt-1">
                                            <div class="srt_013">
                                                <h5 class="text-warning text-bold">You Already Give Us Review To This Product!!!</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="revie_stars d-flex align-items-center justify-content-between px-2 py-2 gray rounded mb-2 mt-1">
                                        <div class="srt_013">
                                            <h5 class="text-warning text-bold">Dear Customer You Did Not Purchase This Product. You Can Not Give Review. </h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="revie_stars d-flex align-items-center justify-content-between px-2 py-2 gray rounded mb-2 mt-1">
                                    <div class="srt_013">
                                        <h5 class="text-warning text-bold">Please Login First For Give Review To This Product!!!</h5>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Product Description End ==================== -->

<!-- ======================= Similar Products Start ============================ -->
<section class="middle pt-0">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="sec_title position-relative text-center">
                    <h2 class="off_title">Recent View Products</h2>
                    <h3 class="ft-bold pt-3">Recent View Products</h3>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="slide_items">
                    
                    <!-- single Item -->
                    @forelse ($recent_viewd_product as $product )
                        <div class="single_itesm">
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
                    @empty
                        <div class="alert alert-warning">Recenty NO Product View</div>
                    @endforelse
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- ======================= Similar Products Start ============================ -->
    
@endsection

@section('footerscript')
<script>
    
    $('.color_id').change(function(){
        let color_id = $(this).val();
        let product_id = {{ $product_id }};
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            url:'/getSize',
            type:'POST',
            data:{'color_id':color_id,'product_id':product_id},
            success:function(data){
               $('#size').html(data)
            }
        });
    });
</script>
<script>
    $('#quantity').change(function(){
        let quantity = $(this).val();
        let price = {{ $price }}
        let total_price = quantity*price;
        $('.price').html('BDT '+total_price);
    });
</script>
<script>
    $('.star').change(function(){
        let star = $(this).val();
        $('#starv').html(star+' Star');
        $('#starinput').val(star);
    });
</script>
@endsection