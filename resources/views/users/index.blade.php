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
                <h3>User List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($all_user as $key=> $user )
                    <tr>
                        <td> {{ $all_user->firstItem()+$key }} </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                         <img  width="100" class="user-img text-center" src="{{ asset('/uploads/users/')}}/{{ $user->image }}" alt="" srcset="">
                        </td>
                        <td>
                            <a href="{{ route('user.delete', $user->id) }}" class="btn btn-dark">
                                <i class="bx bx-trash-alt me-0"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    
                </table>
                {{ $all_user->links() }}
            </div>
        </div>

        @if($total_trash_user != 0)
            <div class="card">
                <div class="card-header">
                    <h3>Trash User List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($trash_user as $key=> $user )
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            <img  width="100" class="user-img text-center" src="{{ asset('/uploads/users/')}}/{{ $user->image }}" alt="" srcset="">
                            </td>
                            <td>
                                <a href="{{ route('user.restore', $user->id) }}" class="btn btn-dark">
                                    <i class="lni lni-reload"></i>
                                </a>
                                <a href="{{ route('user.pdelete', $user->id) }}" class="btn btn-dark">
                                    <i class="bx bx-trash-alt me-0"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </table>
                    
                </div>
            </div>
        @endif
        
        
    </div>
</div>
@endsection