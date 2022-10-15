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
                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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



<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title">Add New Product</h5>
        <hr>
        <div class=" mt-4">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="border border-3 p-4 rounded">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                    <form action="{{ route('product.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                                    <label for="inputProductType" class="form-label">Product Category</label>
                                    <select class="form-select" name="category_id" id="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category )
                                         <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <strong class="text-danger mt-2">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="inputProductType" class="form-label">Product Sub Category</label>
                                    <select class="form-select" name="subcategory_id" id="subcategory_id">
                                        {{--  <option>-- Select Brand --</option>
                                        @foreach ($brands as $brnad )
                                            <option value="{{ $brnad->id }}">{{ $brnad->name }}</option>
                                        @endforeach  --}}
                                    </select>
                                    @error('brand_id')
                                        <strong class="text-danger mt-2">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="inputProductType" class="form-label">Product Brand</label>
                                    <select class="form-select" name="brand_id" id="brand_id">
                                        {{--  <option>-- Select Brand --</option>
                                        @foreach ($brands as $brnad )
                                            <option value="{{ $brnad->id }}">{{ $brnad->name }}</option>
                                        @endforeach  --}}
                                    </select>
                                    @error('brand_id')
                                        <strong class="text-danger mt-2">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        
                        <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">Product Title</label>
                            <input type="text" class="form-control" name="product_title" placeholder="Enter product title">
                            @error('product_title')
                                <strong class="text-danger mt-2">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label  for="inputProductDescription" class="form-label">Description</label>
                                    <textarea id=""  class="form-control"  name="desc"></textarea>
                                    @error('desc')
                                        <strong class="text-danger mt-2">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label  for="inputProductDescription" class="form-label">Long Description</label>
                                    <textarea id=""  class="form-control"  name="long_desc"></textarea>
                                    @error('desc')
                                        <strong class="text-danger mt-2">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="inputPrice" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price">
                                @error('price')
                                <strong class="text-danger mt-2">{{ $message }}</strong>
                            @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="inputPrice" class="form-label">Discount In %</label>
                                <input type="number" class="form-control" name="discount">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="inputProductDescription" class="form-label">Product Images</label>
                            <input id="image-uploadify" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple name="product_image[]">
                        </div>
                        <div class="mb-3">
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Save Product</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> 
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
<script>
    $('#subcategory_id').change(function(){
        let subcategory_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'post',
            url:'/getbrandid',
            data:{'subcategory_id':subcategory_id},
            success:function(data){
                $('#brand_id').html(data);
            }   
        });
    });
</script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
<script>
    tinymce.init({
        selector: '#mytextarea2'
    });
</script>
<script>
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    })
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
