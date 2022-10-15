@extends('forntend.master')

@section('content')
    <section class="middle">
				<div class="container">
				
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="text-center d-block mb-5">
								<h2>Checkout</h2>
							</div>
						</div>
					</div>
					
					<div class="row justify-content-between">
						<div class="col-12 col-lg-7 col-md-12">
							<form action="{{ route('order.store') }}" method="POST">
                                @csrf
								<h5 class="mb-4 ft-medium">Billing Details</h5>
								<div class="row mb-2">
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Full Name *</label>
											<input type="text" class="form-control" name="name" value="{{ Auth::guard('customerlogin')->user()->name }}" readonly/>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Email *</label>
											<input type="email" class="form-control" name="email" value="{{ Auth::guard('customerlogin')->user()->email }}" readonly />
										</div>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Company</label>
											<input type="text" class="form-control" name="company" placeholder="Company Name (optional)" />
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Mobile Number *</label>
											<input type="text" class="form-control" name="mobile" placeholder="Mobile Number" />
										</div>
									</div>
									
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Address *</label>
											<input type="text" class="form-control" name="address" placeholder="Address" />
										</div>
									</div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Division *</label>
											<select class="custom-select division_id" name="division_id">
											  <option value="">-- Select Division --</option>
											  @foreach ($divisions as $division )
                                                  <option value="{{ $division->id }}">{{ $division->name }}</option>
                                              @endforeach
											</select>
										</div>
									</div>
									
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Disctrict *</label>
											<select class="custom-select district_id" name="district_id">
											  <option value="">-- Select District --</option>
											  @foreach ($districts as $district )
                                                  <option value="{{ $district->id }}">{{ $district->name }}</option>
                                              @endforeach
											</select>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label class="text-dark">Upazila *</label>
											<select class="custom-select upazila_id" name="upazila_id">
											  <option value="">-- Select Upazila --</option>
											  @foreach ($upazilas as $upazila )
                                                  <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
                                              @endforeach
											</select>
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">ZIP / Postcode *</label>
											<input type="text" class="form-control" name="zip_code" placeholder="Zip / Postcode" />
										</div>
									</div>
									
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label class="text-dark">Additional Information</label>
											<textarea class="form-control ht-50" name="note"></textarea>
										</div>
									</div>
									
								</div>
								
							
						</div>
						
						<!-- Sidebar -->
						<div class="col-12 col-lg-4 col-md-12">
							<div class="d-block mb-3">
								<h5 class="mb-4">Order Items ({{ $carts_count }})</h5>
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                                    @php
                                        $sub_total = 0;
                                    @endphp
									@foreach ($carts as $cart)
                                        <li class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-3">
                                                    <!-- Image -->
                                                    <a href=""><img src="{{ asset('uploads/products') }}/{{ App\Models\ProductImage::where('product_id',$cart->product_id)->first()->product_image}}" alt="..." class="img-fluid"></a>
                                                </div>
                                                <div class="col d-flex align-items-center">
                                                    <div class="cart_single_caption pl-2">
                                                        <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{ $cart->rel_to_product->product_title }}</h4>
                                                        <p class="mb-1 lh-1"><span class="text-dark">Size: {{ $cart->rel_to_size->size_name }}</span></p>
                                                        <p class="mb-3 lh-1"><span class="text-dark">Color: {{ $cart->rel_to_color->color_name }}</span></p>
                                                        <p class="mb-3 lh-1"><span class="text-dark">Quantity: {{ $cart->quantity }}</span></p>
                                                        <h4 class="fs-md ft-medium mb-3 lh-1">BDT {{ $cart->rel_to_product->after_discount }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @php
                                            $sub_total +=$cart->rel_to_product->after_discount*$cart->quantity;
                                        @endphp
                                        
                                    @endforeach
									
								</ul>
							</div>
							
							<div class="mb-4">
								<div class="form-group">
									<h6>Delivery Location</h6>
									<ul class="no-ul-list">
										<li>
											<input id="inside" class="radio-custom" name="charge" type="radio" value="100">
											<label for="inside" class="radio-custom-label">Inside City</label>
										</li>
										<li>
											<input id="outside" class="radio-custom" name="charge" type="radio" value="150">
											<label for="outside" class="radio-custom-label">Outside City</label>
										</li>
									</ul>
								</div>
							</div>
							<div class="mb-4">
								<div class="form-group">
									<h6>Select Payment Method</h6>
									<ul class="no-ul-list">
										<li>
											<input id="c3" class="radio-custom" name="payment_method" type="radio" value="1">
											<label for="c3" class="radio-custom-label">Cash on Delivery</label>
										</li>
										<li>
											<input id="c4" class="radio-custom" name="payment_method" type="radio" value="2">
											<label for="c4" class="radio-custom-label">Pay With SSLCommerz</label>
										</li>
										<li>
											<input id="c5" class="radio-custom" name="payment_method" type="radio" value="3">
											<label for="c5" class="radio-custom-label">Pay With Stripe</label>
										</li>
									</ul>
								</div>
							</div>
							
							<div class="card mb-4 gray">
							  <div class="card-body">
								<ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Subtotal</span>
                                    <input type="hidden" name="sub_total" value="{{  $sub_total }}" >
                                     <strong class="ml-auto text-dark ft-medium">BDT  
                                        <span class=" total">{{  $sub_total }}</span>
                                    </strong>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Discount
                                    <input type="hidden" name="discount" value="{{ (session('type')==1?($sub_total * session('discount'))/100:session('discount')) }}">    
                                    </span> <strong class="ml-auto text-dark ft-medium">BDT
                                        <span class="discount">{{ (session('type')==1?($sub_total * session('discount'))/100:session('discount')) }}</span> 
                                    </strong>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Charge</span> <span class="ml-auto text-dark ft-medium charge">BDT 0</span>
								  </li>
								  <li class="list-group-item d-flex text-dark fs-sm ft-regular">
									<span>Total
                                    <input type="hidden" class="total_price2" name="total" value="">    
                                    </span> <span class="ml-auto text-dark ft-medium total_price">BDT {{  $sub_total- (session('type')==1?($sub_total * session('discount'))/100:$sub_total-session('discount')) }} </span>
								  </li>
								</ul>
							  </div>
							</div>

							
							<button type="submit" class="btn btn-block btn-dark mb-3">Place Your Order</button>
						</div>
						</form>
					</div>
					
				</div>
			</section>
@endsection

@section('footerscript')
    <script>
        $('#inside').change(function(){
            let inside = $(this).val();
            var total = $('.total').html();
            var discount = $('.discount').html();
            let total_price = parseInt(total)-parseInt(discount)+parseInt(inside);
            $('.charge').html('BDT '+inside);
            $('.total_price').html('BDT '+total_price);
            $('.total_price2').val(total_price);
           
        });
    </script>
    <script>
        $('#outside').change(function(){
            let outside = $(this).val();
            var total = $('.total').html();
            var discount = $('.discount').html();
            let total_price = parseInt(total)-parseInt(discount)+parseInt(outside);
            $('.charge').html('BDT '+outside);
            $('.total_price').html('BDT '+total_price);
            $('.total_price2').val(total_price);
           
        });
    </script>

    <script>
        $('.division_id').change(function(){
            let division_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
                url:'/getdistrict',
                type:'POST',
                data:{'division_id':division_id},
                success:function(data){
                $('.district_id').html(data)
                }
            });
        });
    </script>
    <script>
        $('.district_id').change(function(){
            let district_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
                url:'/getupazila',
                type:'POST',
                data:{'district_id':district_id},
                success:function(data){
                    {{--  alert(data);  --}}
                    $('.upazila_id').html(data)
                }
            });
        });
    </script>
@endsection