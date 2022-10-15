@extends('layouts.app');

@section('content')
    <!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Sub Category</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Sub Category</li>
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
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Sub Category List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>No.</th>
                            <th>Sub Category Name</th>
                            <th>Category Name</th>
                            <th>Sub Category Image</th>
                            <th>Added By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($subcategories as $key=>$subcategory )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->rel_to_category->name }}</td>
                                    <td>{{ $subcategory->category_id }}</td>
                                    <td>{{ $subcategory->rel_to_user->name }}</td>
                                    <td>
                                        <a href="{{ route('status',$subcategory->id) }}"><button class="btn btn-{{ ($subcategory->status==0?'dark':'success') }}">{{ ($subcategory->status==0?'Deactive':'Active') }}</button></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('subcategory.delete',$subcategory->id) }}"><button class="btn btn-danger">Delete</button></a>

                                    </td>
                            @empty
                                    <td colspan="7" class="text-center"><h3>No Sub Category Found</h3></td>
                            </tr>
                        @endforelse
                            
                        
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><h3>Add Sub Category</h3></div>
                <div class="card-body">
                    <form action="{{ route('subcategory_store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <label class="form-label" for="">Select Category</label>
                            <select name="category_id" class="form-select" id="">
                                <option class="form-group" value="">--Select Category--</option>
                                @forelse ($categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" for="">Sub Category Name</label>
                            <input class="form-control" type="text" name="name" id="">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" for="">Sub Category Name</label>
                            <input class="form-control" type="file"  name="image" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                            <img id="pic" width="100" class="float-right mt-2">
                            @error('image')
                                <strong class="text-danger mt-2">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary" type="submit">Add Sub Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>            
</div>
@endsection