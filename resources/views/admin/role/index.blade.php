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
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h3>Role And Permission</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>Sl</td>
                        <td>Role Name</td>
                        <td>Permission</td>
                        <td>
                           Action
                        </td>
                    </tr>
                    @foreach ($roles as $key=>$role )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <ul>
                                @foreach ($role->getAllPermissions() as $permission )
                                    <li> {{ $permission->name }}</li>
                                 @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('edit.permission',$role->id) }}" class="btn btn-success">
                                <i class="lni lni-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">Add Permission</div>
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="post">
                    @csrf
                    <div class="mt-2">
                        <label for="permission" class="form-label">Permission Name</label>
                        <input type="text" name="permission" class="form-control" id="">
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary mt-2">Add permission</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Create Role</div>
            <div class="card-body">
                <form action="{{ route('create.role') }}" method="post">
                    @csrf
                    <div class="mt-2">
                        <label for="permission" class="form-label">Role Name</label>
                        <input type="text" name="role" class="form-control" id="">
                    </div>
                    <div class="mt-3">
                        <label for="permission" class="form-label">Permission Name</label>
                        <br>
                        @foreach ($permissions as $permission )
                            <input type="checkbox" name="permission[]" class="form-checkbox mt-2"  value="{{ $permission->id }}"> {{ $permission->name }}
                            <br>
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary mt-2">Create Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection