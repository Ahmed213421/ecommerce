<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $users = $this->adminService->getAllAdmins();
        return view('dashboard.role-permission.user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('dashboard.role-permission.user.create', ['roles' => $roles]);
    }

    public function store(AdminStoreRequest $request)
    {
        $this->adminService->createAdmin($request->all(), $request->roles ?? []);

        return redirect()->route('admin.users.index')->with('status', trans('spatie.user_created'));
    }

    public function edit(Admin $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('dashboard.role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(AdminUpdateRequest $request, Admin $user)
    {
        $this->adminService->updateAdmin($user, $request->all(), $request->roles ?? []);

        return redirect()->route('admin.users.index')->with('status', trans('spatie.user_updated'));
    }

    public function destroy($userId)
    {
        $this->adminService->deleteAdmin($userId);
        return redirect()->route('admin.users.index')->with('status', trans('spatie.user_deleted'));
    }
}
