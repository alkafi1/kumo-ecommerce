<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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

    function role_assign(){
        $users = User::all();
        $all_users_with_all_their_roles =  User::with("roles")->whereHas("roles")->get();
        $roles = Role::all();
        return view('admin.role.role_assign',[
            'users' => $users,
            'all_users_with_all_their_roles' => $all_users_with_all_their_roles,
            'roles' => $roles,
        ]);
    }
    function role_assign_user(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);
        return back()->with('succes', 'Successfully Role assign To User');
    }
}
