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
									<li class="breadcrumb-item"><a href="#">Support</a></li>
									<li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
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
    
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="text-center d-block mb-5">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-between">
            
                
            
                <div class="col-12 col-lg-7 col-md-12">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                            
                        <li class="list-group-item">
                            @php
                                $sub_total = 0;
                                $price = 0;
                            @endphp
                            @forelse ($carts as $key=>$cart )
                            <div class="row align-items-center mt-2">
                                <div class="col-3">
                                    <!-- Image -->
                                    <a href="product.html"><img src="{{ asset('uploads/products') }}/{{ App\Models\ProductImage::where('product_id',$cart->product_id)->first()->product_image}} " alt="..." class="img-fluid"></a>
                                </div>
                                <div class="col d-flex align-items-center justify-content-between">
                                    <div class="cart_single_caption pl-2">
                                        <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{ $cart->rel_to_product->product_title }}</h4>

                        <form action="{{ route('cart.update') }}" method="post">
                            @csrf
                                        <p class="mb-1 lh-1"><span class="text-dark">Size: {{ $cart->rel_to_size->size_name }}</span></p>

                                        <p class="mb-3 lh-1"><span class="text-dark">Color: {{ $cart->rel_to_color->color_name }}</span></p>

                                        {{--  <input class=" color_id form-check-input" type="radio" name="color_id" id="color" value="{{ $cart->color_id }}">
                                        <label class="form-option-label rounded-circle" for="color">
                                            <span style="background: {{ $cart->rel_to_color->color_code }} " class="form-option-color rounded-circle "></span>
                                        </label>  --}}

                                        <h4 class="fs-md ft-medium mb-3 lh-1 price abc">BDT {{ $cart->quantity * $cart->rel_to_product->after_discount }}</h4>
                                        @php
                                            $price =$cart->rel_to_product->after_discount;
                                            $sub_total+= $cart->quantity * $cart->rel_to_product->after_discount;
                                        @endphp
                                        
                                        <input class="" type="number" name="quantity[{{ $cart->id }}]" id="quantity" value="{{ $cart->quantity }}" class="form-control " placeholder="Quantity">
                                        @error('quantity')
                                            <strong class="text-danger mt-2">{{ $message }}</strong>
                                        @enderror
                                        {{--  <select value="{{ $cart->quantity }}" class="mb-2 custom-select w-auto">
                                            <option value="{{ $cart->quantity }}" selected="">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>  --}}
                                        {{--  <!-- Quantity -->
                                            
                                        <button type="button" style="background-color: #4CAF50;border: none;color: white;padding: 10px 15px;text-align: center;text-decoration: none;display: inline-block;" class=" input_number_decrement">
                                                <i class="ti-minus"></i>
                                            </button>
                                            <input class="form-control" type="number" name="quantity" id="" placeholder="Quantity">
                                            <button type="button" class="btn input_number_increment">
                                                <i class="ti-plus"></i>
                                            </button>  --}}
                                    </div>
                                    <div class="fls_last">
                                        <a class="close_slide gray" href="{{ route('cart.delete',$cart->id) }}"><i class="ti-close"></i></a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <h3 class="text-center">No Product On Your Cart!!!</h3>
                            @endforelse
                            <div class="row">
                            <div class="col-12 col-md-12 float-end  mt-3">
                                <button type="submit" class="btn stretched-link borders">Update Cart</button>
                            </div>
                        </form>
                        </div>
                        </li>
                        
                    </ul>
                    
                    <div class="row align-items-end justify-content-between mb-10 mb-md-0">
                        {{--  <div class="col-12 col-md-auto mfliud">
                            <button type="submit" class="btn stretched-link borders">Update Cart</button>
                        </div>  --}}

                        <div class="col-12 col-md-12">
                            <!-- Coupon -->
                            <form class="mb-7 mb-md-0">
                                <label class="fs-sm ft-medium text-dark">Coupon code:</label>
                                <div class="row form-row">
                                    <form action="{{ route('cart.page') }}" method="get">
                                    <div class="col">
                                        <input class="form-control" type="text" name="coupon_name" value="" placeholder="Enter coupon code*">
                                        @if ($msg)
                                            <div class="alert alert-danger">{{ $msg }}</div>
                                        @endif
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-dark" type="submit">Apply</button>
                                    </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div> 
            
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card mb-4 gray mfliud">
                        <div class="card-body">
                        <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                            <span>Subtotal</span> <span class="ml-auto text-dark ft-medium">{{ $sub_total }}</span>
                            </li>
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                                @php
                                    session([
                                        'discount' => $discount,
                                        'type' => $type,
                                    ])
                                @endphp
                            <span>Discount</span> <span class="ml-auto text-dark ft-medium">{{ $discount }} {{ ($type ==1?'%':'BDT') }}</span>
                            </li>
                            <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                            <span>Total</span> <span class="ml-auto text-dark ft-medium">
                                {{ ($type == 1?$sub_total-(($sub_total * $discount)/100):$sub_total-$discount) }}
                            </span>
                            </li>
                            <li class="list-group-item fs-sm text-center">
                            Shipping cost calculated at Checkout *
                            </li>
                        </ul>
                        </div>
                    </div>
                    
                    <a class="btn btn-block btn-dark mb-3" href="{{ route('checkout') }}">Proceed to Checkout</a>
                    
                    <a class="btn-link text-dark ft-medium" href="shop.html">
                        <i class="ti-back-left mr-2"></i> Continue Shopping
                    </a>
                </div>
        </div>
        
    </div>
</section>
<!-- ======================= Product Detail End ======================== -->
    
@endsection

@section('footerscript')
    <script>
        $('#quantity').change(function(){
            let quantity = $(this).val();
            let price = {{ $price }}
            let total_price = quantity*price;
            $('.price').html('BDT '+total_price);
           
        });
    </script>
@endsection