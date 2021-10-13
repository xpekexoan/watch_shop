<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateInfo;
use App\Http\Requests\User\UpdatePassword;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showInfo()
    {
        $user = Auth::user();
        return view('user.profile.info',compact('user'));
    }
    public function updateInfo(UpdateInfo $request)
    {
        $data = $request->only(['name', 'tel', 'id_district', 'address']);
        User::findOrFail(Auth::user()->id)->update($data);
        return back()->with('alert-success', 'Cập nhật thông tin thành công!');
    }
    public function showFormChangePassword()
    {
        return view('user.profile.change_password');
    }
    public function updatePassword(UpdatePassword $request)
    {
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }
        $data['password'] = Hash::make($request->password);
        User::findOrFail(Auth::user()->id)->update($data);
        return back()->with('alert-success', 'Thay đổi mật khẩu thành công!');
    }

}
