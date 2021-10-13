<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect(route('index'));
        }
        return view('user.login.index');
    }

    public function login(LoginRequest $request)
    {
        $crendentials = $request->only('email', 'password');
        $bool = $request->has('remember') ? true : false;
        if (Auth::attempt($crendentials, $bool)) {
            return redirect(route('index'));
        }
        return back()->with('alert-fail', 'Đăng nhập thất bại!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
