@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Category List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Added By</th>
                        <th>Cretaed At</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($categories as $key=>$category )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <img  width="100" src="{{ asset('/uploads/categories/')}}/{{ $category->image }}" alt="" srcset="">
                        </td>
                        <td>{{ $category->rel_to_user->name }}</td>
                        <td>{{ $category->created_at->diffForhumans() }}</td>
                        <td>
                            @can('delete_category')
                                
                            
                            <a href="{{ route('category.delete', $category->id) }}" class="btn btn-dark">
                                <i class="lni lni-trash"></i>
                            </a>
                            @else
                            You are not Admin
                            @endcan
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
                <h3>Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input class="form-control" type="text" name="name">
                        @error('name')
                            <strong class="text-danger mt-2">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="category_image" class="form-label">Category Image</label>
                            <input class="form-control" type="file"  name="image" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                            <img id="pic" width="100" class="float-right mt-2">
                            @error('image')
                                <strong class="text-danger mt-2">{{ $message }}</strong>
                            @enderror
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
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