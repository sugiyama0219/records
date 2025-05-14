<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|max:10|unique:admins,user_id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'user_id' => $request->user_id,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('admin')->login($admin);

        return view('admin.auth.reg_comp');
    }
}
