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
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Brand List</h3>
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
                        <td>{{ $key+1 }}</td>
                        <td>{{ $brand->rel_to_category->name }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            <img  width="100" src="{{ asset('/uploads/brands/')}}/{{ $brand->image }}" alt="" srcset="">
                        </td>
                        <td>{{ $brand->rel_to_user->name }}</td>
                        <td>{{ $brand->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('brand.delete', $brand->id) }}" class="btn btn-dark">
                                <i class="lni lni-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $brands->links() }}
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Create Brand</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2">
                        <label for="brand_name" class="form-label">Brand Name</label>
                        <input class="form-control" type="text" name="name">
                        @error('name')
                            <strong class="text-danger mt-2">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">Brand Category</label>
                        <select name="category_id" id="category_id" class="form-select" >
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category )
                                <option value="{{ $category->id }}" class="">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">Brand Sub Category</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-select" >
                            {{--  @foreach ($subcategories as $subcategory )
                                <option value="{{ $subcategory->id }}" class="">{{ $subcategory->name }}</option>
                            @endforeach  --}}
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="image" class="form-label">Brand Image</label>
                            <input class="form-control" type="file"  name="image" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                            <img id="pic" width="100" class="float-right mt-2">
                            @if(session('image'))
                                <strong class="text-danger mt-2">{{ session('image') }}</strong>
                            @endif
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">Add Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
    $('#category_id').change(function(){
        let category_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'post',
            url:'/getsubcategoryid',
            data:{'category_id':category_id},
            success:function(data){
                $('#subcategory_id').html(data);
            }   
        });
    });
</script>
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