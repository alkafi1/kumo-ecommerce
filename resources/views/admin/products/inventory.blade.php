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
                <h3>Inventory Of {{ $product_info->product_title }} </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>List Of  Inventory </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Product Name</th>
                                        <th>Product Color</th>
                                        <th>Product Size</th>
                                        <th>Product Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse ($inventories as $key=>$iventory )
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $iventory->product_name}}</td>
                                            <td>{{ $iventory->rel_to_color->color_name}}</td>
                                            <td>{{ $iventory->rel_to_size->size_name}}</td>
                                            <td>{{ $iventory->product_quantity}}</td>
                                            <td>
                                                <a href="{{ route('inventory.status', $iventory->id) }}" class="btn btn-{{ (($iventory->status ==0)?'dark':'success') }}">
                                                    <i class="lni lni-{{ (($iventory->status ==0)?'close':'checkmark') }}"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('brand.delete', $iventory->id) }}" class="btn btn-dark">
                                                    <i class="lni lni-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add Product Variation And Quantity</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('inventory.store') }}" method="post"> 
                                    @csrf
                                    <div class="mt-2">
                                        <label for="" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" name="product_name" id="" value="{{ $product_info->product_title }}" readonly>
                                        <input type="hidden" name="product_id" value="{{ $product_info->id }}" >
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="form-label">Product Color</label>
                                        <select class="form-select" name="color_id" id="color_id">
                                            <option value="">-- Select Color --</option>
                                            @foreach ($colors as $color )
                                             <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('color_id')
                                            <strong class="text-danger mt-2">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="form-label">Product Size</label>
                                        <select class="form-select" name="size_id" id="size_id">
                                            <option value="">-- Select Color --</option>
                                            @foreach ($sizes as $size )
                                             <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('color_id')
                                            <strong class="text-danger mt-2">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="form-label">Product Quantiry</label>
                                        <input type="number" class="form-control" name="product_quantity" id="">
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary">Add Inventory</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection