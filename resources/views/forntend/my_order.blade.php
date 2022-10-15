@extends('forntend.profile_master')

@section('account')
    <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
							<!-- Single Order List -->
							@forelse ($orders as $order )
								<div class="ord_list_wrap border mb-4">
									<div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
										<div class="olh_flex">
											<p class="m-0 p-0"><span class="text-muted">Order Number</span></p>
											<h6 class="mb-0 ft-medium">{{ $order->id }}</h6>
										</div>		
									</div>
									<div class="ord_list_body text-left">
										<!-- First Order -->
										<div class="row align-items-center justify-content-center m-0 py-4 br-bottom">
											<div class="col-xl-5 col-lg-5 col-md-5 col-12">
												<div class="cart_single d-flex align-items-start mfliud-bot">
													<div class="cart_single_caption pl-3">
														<span class="text-dark medium class="mb-2"">Sub Total: {{ $order->sub_total }} </span><br>
														 <span class="text-dark medium">Discount: {{ $order->discount }} </span><br>
														<span class="text-dark medium class="mb-2"">Charge: {{ $order->charge }}</span><br>
														 <span class="text-dark medium">Total: {{ $order->total }}</span>
													</div>
												</div>
											</div>
											<div class="col-xl-2 col-lg-2 col-md-2 col-12 ml-auto">
												<p class="mb-1 p-0"><span class="text-muted">Status</span></p>
												<div class="delv_status"><span class="ft-medium small text-warning bg-light-warning rounded px-3 py-1">Completed</span></div>
											</div>
											<div class="col-xl-2 col-lg-2 col-md-2 col-12 ml-auto">
												<p class="mb-1 p-0"><span class="text-muted">Download</span></p>
												<div class="delv_status">
													<a target="blank" href="{{ route('invoice.download',$order->id) }}"><span class="ft-medium small text-success bg-light-success rounded px-3 py-1">Invoice</span></a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="ord_list_footer d-flex align-items-center justify-content-between br-top px-3">
										<div class="col-xl-12 col-lg-12 col-md-12 pl-0 py-2 olf_flex d-flex align-items-center justify-content-between">
											<div class="olf_flex_inner"><p class="m-0 p-0"><span class="text-muted medium text-left">Order Date: 10.12.2021</span></p></div>
											<div class="olf_inner_right"><h5 class="mb-0 fs-sm ft-bold">Total: $4510</h5></div>
										</div>
									</div>
								</div>
							@empty
								<div class="ord_list_head gray d-flex align-items-center justify-content-between px-3 py-3">
										<div class="olh_flex">
											<p class="m-0 p-0"><span class="text-muted">NO Order</span></p>
											<h6 class="mb-0 ft-medium"></h6>
										</div>		
									</div>
							@endforelse
							
							<!-- End Order List -->
							
						</div>
@endsection