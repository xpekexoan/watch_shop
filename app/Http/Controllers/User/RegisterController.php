<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\RegisterRequest;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('user.signup.index');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'tel', 'email', 'password']);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        $crendentials = $request->only('email', 'password');
        Auth::attempt($crendentials);
        return redirect(route('index'))->with('alert-success', 'Đăng kí thành công!');
    }
}
