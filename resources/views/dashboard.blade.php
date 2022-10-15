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
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="row">
        <div class="col-lg-4">
            <div class="card radius-10 bg-success">
                <div class="card-body" style="position: relative;">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Users</p>
                            <h5 class="mb-0">{{ $total_user }}</h5>
                        </div>
                        <div class="widgets-icons bg-white text-dark ms-auto"><i class="bx bxs-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card radius-10 bg-primary">
                <div class="card-body" style="position: relative;">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Category</p>
                            <h5 class="mb-0">{{ $total_category }}</h5>
                        </div>
                        <div class="widgets-icons bg-white text-dark ms-auto"><i class="bx bxs-category"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card radius-10 bg-info">
                <div class="card-body" style="position: relative;">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Brand</p>
                            <h5 class="mb-0">{{ $total_brand }}</h5>
                        </div>
                        <div class="widgets-icons bg-white text-dark ms-auto"><i class='bx bxs-speaker'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</div>
@endsection
