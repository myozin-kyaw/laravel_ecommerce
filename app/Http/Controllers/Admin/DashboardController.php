<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function myUsers()
    {
        $admins = User::where('role_as','1')->get();
        $users = User::where('role_as','0')->get();
        return view('admin.users.myusers', compact('admins', 'users'));
    }

    public function viewUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.viewuser', compact('user'));
    }
}
