<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        $all_user = User::Paginate(5);
        $total_trash_user = User::onlyTrashed()->count();
        $trash_user = User::onlyTrashed()->get();
        return view('users.index',[
            'all_user' => $all_user,
            'total_trash_user' => $total_trash_user,
            'trash_user' => $trash_user,
        ]);
    }

    function user_delete($user_id)
    {
        User::find($user_id)->delete();
        return back()->with('success','User Trashed Succesfully.');
    }
    function user_restore($user_id)
    {
        User::onlyTrashed()->find($user_id)->restore();
        return back()->with('success','User Restore Succesfully.');
    }
    function user_pdelete($user_id)
    {
        $user_info = User::onlyTrashed()->find($user_id);
        if($user_info->image == 'default.png'){
            User::onlyTrashed()->find($user_id)->forceDelete();
            return back()->with('success','User Delete Permanently.');
        }
        else{
            $delete_image = public_path('/uploads/users/'.$user_info->image);
            unlink($delete_image);
            User::onlyTrashed()->find($user_id)->forceDelete();
            return back()->with('success','User Delete Permanently.');
        }
    }
}
