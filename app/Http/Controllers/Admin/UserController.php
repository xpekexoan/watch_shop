<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUser;
use App\Http\Requests\User\UpdateUser;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\User\ResetPassword;

class UserController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = Config::get('constants.limit_page');
    }

    public function index()
    {
        $users = User::whereNotIn('id', [1])->orderBy('id', 'desc')->paginate($this->limit);
        $roles = Role::all();
        // dd($users);
        return view('admin.user.list', compact('users', 'roles'));
    }

    public function detail($id)
    {
        if ($id == Role::ADMIN) {
            return back()->with('alert-fail', 'Không thể truy cạp!');
        }
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.detail', compact(['roles', 'user']));
    }

    public function showCreateForm()
    {
        $roles = Role::all();
        $id_cus = Role::CUSTOMER;
        return view('admin.user.add', compact(['roles', 'id_cus']));
    }

    public function create(CreateUser $request)
    {
        $data = $request->only(['name', 'tel', 'email', 'password', 'id_district', 'address', 'id_role']);
        $data['password'] = Hash::make($data['password']);
        $new = User::create($data);
        return redirect(route('admin.user.detail', ['id' => $new->id]))->with('alert-success', 'Tạo mới thành công!');
    }

    public function update(UpdateUser $request, $id)
    {
        if ($id == Role::ADMIN) {
            return back()->with('alert-fail', 'Không thể truy cập!');
        }
        $data = $request->only(['name', 'tel', 'id_district', 'address', 'id_role']);
        User::findOrFail($id)->update($data);
        return back()->with('alert-success', 'Cập nhật thành công!');
    }

    function showFormResetPassword($id)
    {
        return view('admin.user.reset_password', compact('id'));
    }

    function resetPassword(ResetPassword $request, $id)
    {
        $data = $request->only('password');
        $data['password'] = Hash::make($data['password']);
        User::findOrFail($id)->update($data);
        return redirect(route('admin.user.detail', ['id' => $id]))->with('alert-success', 'Đặt lại mật khẩu thành công!');
    }

    public function search(Request $request)
    {
        $columns = $request->only(['id', 'name', 'email', 'id_role', 'status']);
        $roles = Role::all();

        $query = User::query();
        $strict = ['id', 'id_role'];
        foreach ($columns as $column => $value) {
            if (is_null($value)) {
                continue;
            }
            if (in_array($column, $strict)) {
                $query = $query->where($column, $value);
            } else {
                $query = $query->where($column, 'like', '%' . $value . '%');
            }
        }
        $users = $query->whereNotIn('id', [1])->orderBy('id', 'desc')->paginate($this->limit)->appends($columns);
        return view('admin.user.list', compact('users', 'roles', 'request'));
    }

    public function block($id)
    {
        if ($id == Role::ADMIN) {
            return response()->json(['message'=>'Không thể truy cập!'], 404);
        }
        $user = User::findOrFail($id)->update(['status' => 0]);
		return response()->json(['message'=>'Chặn tài khoản thành công!']);
    }

    public function active($id)
    {
        if ($id == Role::ADMIN) {
            return response()->json(['message'=>'Không thể truy cập!'], 404);
        }
        $user = User::findOrFail($id)->update(['status' => true]);
		return response()->json(['message'=>'Kích hoạt tài khoản thành công!']);
    }
}
