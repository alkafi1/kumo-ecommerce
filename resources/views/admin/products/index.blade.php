@extends('layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Product</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Product List</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary">Settings</button>
            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                <a class="dropdown-item" href="javascript:;">Another action</a>
                <a class="dropdown-item" href="javascript:;">Something else here</a>
                <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
            </div>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Product List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>sl</th>
                        <th>Product Title</th>
                        <th>Product Brand</th>
                        <th>Product Category</th>
                        <th>Product Description</th>
                        <th>Price</th>
                        <th>Discount In %</th>
                        <th>Price After Discount</th>
                        <th>Product Image</th> 
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $key=>$product )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $product->product_title }}</td>
                        <td>{{ $product->rel_to_brand->name }}</td>
                        <td>{{ $product->rel_to_category->name }}</td>
                        <td>{!! $product->description !!}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount}}<span>% </span></td>
                        <td>{{ $product->after_discount }}</td>
                        <td>
                            
                            @foreach (App\Models\ProductImage::where('product_id',$product->id)->get() as $image )
                                 <img width="100" src="{{ asset('/uploads/products/')}}/{{ $image->product_image }}">
                            @endforeach
                        </td>
                        <td>{{ $product->rel_to_user->name }}</td>
                        <td>
                            @if($product->status == 1)
                                <a  href="{{ route('product.inventory',$product->id) }}"><button class=" btn btn-info">Ineventory</button></a>
                            @endif
                            
                            <a href="{{ route('product.status',$product->id) }}"><button class=" mt-2 btn btn-{{ ($product->status==1)?'success':'dark' }}">{{ ($product->status==1)?'Active':'Deactive' }}</button></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
                {{--  <h6 class="mb-0 text-uppercase">DataTable Import</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
                                        <th>sl</th>
                                        <th>Product Title</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Discount In %</th>
                                        <th>Price After Discount</th>
                                        <th>Product Image</th> 
                                        <th>Added By</th>
                                        <th>Action</th>
                                    </tr>
								</thead>
								<tbody>
                                    @foreach ($products as $key=>$product )
									<tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $product->product_title }}</td>
                                        <td>{{ $product->rel_to_brand->name }}</td>
                                        <td>{{ $product->rel_to_category->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->discount }}</td>
                                        <td>{{ $product->after_discount }}</td>
                                        <td>{{ $product->rel_to_user->name }}</td>
                                        <td>{{ $product->added_by }}</td>
                                        <td>
                                            <button class="btn btn-primary">gjb</button>
                                        </td>
                                    </tr>
                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>  --}}
    </div>
</div>

@endsection

@section('footer_script')
<script>
    $(document).ready(function() {
        $('#example').DataTable({

           });
        } );
</script>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
        
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    } );
</script>
@endsection
