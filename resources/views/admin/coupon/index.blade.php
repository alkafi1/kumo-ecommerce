@extends('layouts.app')

@section('content')
    <!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Coupon</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Coupon List</li>
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
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Coupon List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Sl</th>
                        <th>Coupon Name</th>
                        <th>Coupon Type</th>
                        <th>Discount Amount</th>
                        <th>Minimum Amount</th>
                        <th>Maximum Amount</th>
                        <th>Validity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($coupons as $key=>$coupon )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $coupon->coupon_name }}</td>
                            <td>{{ ($coupon->coupon_type==1)?'Parcentage':'Fixed Amount' }}</td>
                            <td>{{ $coupon->discount_amount }}</td>
                            <td>{{ $coupon->min_amount }}</td>
                            <td>{{ $coupon->max_amount }}</td>
                            <td>{{ $coupon->validity }}</td>
                            <td>
                                <a href="{{ route('coupon.status',$coupon->id) }}"><button class="btn btn-{{ ($coupon->status==0?'dark':'success') }}">{{ ($coupon->status==0?'Inactive':'Active') }}</button></a>
                            </td>
                            <td>
                                <a href="{{ route('coupon.delete',$coupon->id) }}"><button class="btn btn-danger">Delete</button></a>
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
                <h3>Add Coupon</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('coupon.store') }}" method="post">
                    @csrf
                    <div class="mt-2">
                        <label for="name">Coupon Name</label>
                        <input type="text" class="form-control mt-2" name="coupon_name" id="name">
                    </div>
                    <div class="mt-2">
                        <label for="type">Coupon Type</label>
                        <select class="form-select mt-2" name="coupon_type" id="type">
                            <option class="form-control" value="1">Parcentage</option>
                            <option class="form-control" value="2">Fixed Amount</option>
                        </select>
                    </div>
                     <div class="mt-2">
                        <label for="amount">Discount Amount</label>
                        <input type="number" class="form-control mt-2" name="discount_amount" id="amount">
                    </div>
                     <div class="mt-2">
                        <label for="amount">Minimum Amount</label>
                        <input type="number" class="form-control mt-2" name="min_amount" id="amount">
                    </div>
                     <div class="mt-2">
                        <label for="amount">Maximum Amount</label>
                        <input type="number" class="form-control mt-2" name="max_amount" id="amount">
                    </div>
                    <div class="mt-2">
                        <label for="amount">Validity</label>
                        <input type="date" class="form-control mt-2" name="validity" id="amount">
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">Add Coupon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    
@endsection