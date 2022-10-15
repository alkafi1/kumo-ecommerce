@extends('layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">User List</li>
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
                <h3>Trashed Brand List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>sl</th>
                        <th>Brand Category</th>
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Added By</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($brands as $key=>$brand )
                    <tr>
                        <td>{{ $key+1 }}/{{ $brand->id }}</td>
                        <td>{{ $brand->rel_to_category->name }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            <img  width="100" src="{{ asset('/uploads/brands/')}}/{{ $brand->image }}" alt="" srcset="">
                        </td>
                        <td>{{ $brand->rel_to_user->name }}</td>
                        <td>{{ $brand->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('brand.restore', $brand->id) }}" class="btn btn-dark">
                                    <i class="lni lni-reload"></i>
                                </a>
                            <a href="{{ route('brand.pdelete', $brand->id) }}" class="btn btn-dark">
                                <i class="lni lni-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
@if('success')
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: "{{ session('success') }}"
        })
    </script>
@endif
@endsection