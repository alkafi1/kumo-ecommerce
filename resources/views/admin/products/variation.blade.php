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
                <h3>Color</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>Color List</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Color Name</th>
                                        <th>Color Code</th>
                                        <th>Color Preview</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($colors as $key=>$color )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $color->color_name }}</td>
                                        <td>{{ $color->color_code }}</td>
                                        <td>{{ $color->color_code }}</td>
                                        <td>
                                            <a href="{{ route('color.delete',$color->id) }}"><button class="btn btn-danger">Delete</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add color</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('color.store') }}" method="post">
                                    @csrf
                                    <div class="mt-2">
                                        <label for="brand_name" class="form-label">Color Name</label>
                                        <input class="form-control" type="text" name="color_name">
                                        @error('name')
                                            <strong class="text-danger mt-2">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label for="brand_name" class="form-label">Color Code</label>
                                        <input class="form-control" type="text" name="color_code">
                                        @error('color_code')
                                            <strong class="text-danger mt-2">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary">Add Color</button>
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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Size</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>Size List</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Size Name</th>
                                        <th>Size Detail</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($sizes as $key=>$size )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $size->size_name }}</td>
                                        <td>{{ $size->size_detail }}</td>
                                        <td>
                                            <a href="{{ route('size.delete',$size->id)}}"><button class="btn btn-danger">Delete</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add Size</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('size.store') }}" method="post">
                                    @csrf
                                    <div class="mt-2">
                                        <label for="brand_name" class="form-label">Size Name</label>
                                        <input class="form-control" type="text" name="size_name">
                                        @error('size_name')
                                            <strong class="text-danger mt-2">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <label for="brand_name" class="form-label">Size Details</label>
                                        <input class="form-control" type="text" name="size_detail">
                                        @error('color_code')
                                            <strong class="text-danger mt-2">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary">Add Size</button>
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