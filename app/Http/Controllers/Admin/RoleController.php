<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\Admin\RoleService;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Http\Requests\Admin\GivePermissionRequest;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        return view('dashboard.role-permission.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('dashboard.role-permission.role.create');
    }

    public function store(RoleStoreRequest $request)
    {
        $this->roleService->createRole($request->validated());

        return redirect()->route('admin.roles.index')->with('status', trans('spatie.role_created'));
    }

    public function edit(Role $role)
    {
        return view('dashboard.role-permission.role.edit',[
            'role' => $role
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->roleService->updateRole($role->id, $request->validated());

        return redirect()->route('admin.roles.index')->with('status', trans('spatie.role_updated'));
    }

    public function destroy($roleId)
    {
        $this->roleService->deleteRole($roleId);
        return redirect()->route('admin.roles.index')->with('status', trans('spatie.role_deleted'));
    }

    public function addPermissionToRole($roleId)
    {
        $data = $this->roleService->getRolePermissionsData($roleId);

        return view('dashboard.role-permission.role.add-permissions', $data);
    }

    public function givePermissionToRole(GivePermissionRequest $request, $roleId)
    {
        $this->roleService->assignPermissionsToRole($roleId, $request->permission);

        return redirect()->back()->with('status', trans('spatie.permissions_added_to_role'));
    }
}
