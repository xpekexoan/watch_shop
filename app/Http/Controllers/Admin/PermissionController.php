<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Role;

class PermissionController extends Controller
{
    public function index($id_role = null)
    {
        $roles = Role::all()->except(['id' => Role::ADMIN]);
        $id_role = $id_role ?? Role::MANAGER;
        $permissions = DB::table('permission')
            ->leftJoin('role_permission', function ($join) use ($id_role) {
                $join->on('permission.id', '=', 'role_permission.id_permission')
                    ->where('role_permission.id_role', $id_role);
            })
            ->orderBy('description', 'asc')->get();
        return view('admin.permission.index', compact('roles', 'permissions', 'id_role'));
    }

    public function update(Request $request, $id_role = null)
    {
        $id_role = $id_role ?? Role::MANAGER;
        $role = Role::findOrFail($id_role);
        $role->permissions()->sync($request->permission);
        return back()->with('alert-success', 'Cập nhật thành công!');
    }
}
