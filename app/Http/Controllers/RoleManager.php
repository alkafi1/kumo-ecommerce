<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManager extends Controller
{
    function role_manager(){
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.role.index',[
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }

    function permission_store(Request $request)
    {
        $permission = Permission::create(['name' => $request->permission]);
        return back()->with('success','Permission Inserted.');
    }
    function create_role(Request $request)
    {
        $role = Role::create(['name' => $request->role]);
        $role->givePermissionTo($request->permission);
        return back()->with('success','Role Created!!!');
    }
    function edit_permission($role_id){
        $role = Role::find($role_id);
        $permissions = Permission::all();
        return view('admin.role.edit_permission',[
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    function role_permission_upadate(Request $request)
    {
        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permission);
        return back()->with('success','Role Created!!!');
    }
}
