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
        <div class="col-lg-6 m-auto" >
            <div class="card">
                <div class="card-header"><h3>Edit Permission</h3></div>
                <div class="card-body">
                    <form action="{{ route('role.permission.upadate') }}" method="post">
                        @csrf
                        <div class="mt-2">
                            <label for="permission" class="form-label">Role Name</label>
                            <input type="hidden" name="role_id" value="{{ $role->id }}">
                            <input type="text" readonly class="form-control" value="{{ $role->name }}">
                        </div>
                        <div class="mt-3">
                            <label for="permission" class="form-label">Permission Name</label>
                            <br>
                            @foreach ($permissions as $permission )
                                <input type="checkbox" {{ ($role->hasPermissionTo($permission->name)?'checked':'') }} name="permission[]" class="form-checkbox mt-2"  value="{{ $permission->id }}"> {{ $permission->name }}
                                <br>
                            @endforeach
                            
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mt-2">Upadte Permission Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection