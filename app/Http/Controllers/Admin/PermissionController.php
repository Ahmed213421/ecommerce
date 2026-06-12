<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Services\Admin\PermissionService;
use App\Http\Requests\Admin\PermissionStoreRequest;
use App\Http\Requests\Admin\PermissionUpdateRequest;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $permissions = $this->permissionService->getAllPermissions();
        return view('dashboard.role-permission.permission.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('dashboard.role-permission.permission.create');
    }

    public function store(PermissionStoreRequest $request)
    {
        $this->permissionService->createPermission($request->validated());

        return redirect()->route('admin.permissions.index')->with('status', trans('spatie.permission_created'));
    }

    public function edit(Permission $permission)
    {
        return view('dashboard.role-permission.permission.edit', ['permission' => $permission]);
    }

    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $this->permissionService->updatePermission($permission->id, $request->validated());

        return redirect()->route('admin.permissions.index')->with('status', trans('spatie.permission_updated'));
    }

    public function destroy($permissionId)
    {
        $this->permissionService->deletePermission($permissionId);
        return redirect()->route('admin.permissions.index')->with('status', trans('spatie.permission_deleted'));
    }
}
