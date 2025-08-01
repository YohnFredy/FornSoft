<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function show(User $user)
    {
        return view('admin.users.create' , compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit' , compact('user'));
    }
}
