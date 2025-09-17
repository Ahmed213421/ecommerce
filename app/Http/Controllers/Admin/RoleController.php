<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Interfaces\RoleRepositoryInterface;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        // $this->middleware('permission:view role', ['only' => ['index']]);
        // $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        // $this->middleware('permission:update role', ['only' => ['update','edit']]);
        // $this->middleware('permission:delete role', ['only' => ['destroy']]);
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->getAll();
        return view('dashboard.role-permission.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('dashboard.role-permission.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        $this->roleRepository->create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.roles.index')->with('status','Role Created Successfully');
    }

    public function edit(Role $role)
    {
        return view('dashboard.role-permission.role.edit',[
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $this->roleRepository->update($role->id, [
            'name' => $request->name
        ]);

        return redirect()->route('admin.roles.index')->with('status','Role Updated Successfully');
    }

    public function destroy($roleId)
    {
        $this->roleRepository->delete($roleId);
        return redirect()->route('admin.roles.index')->with('status','Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = $this->roleRepository->find($roleId);
        $rolePermissions = $this->roleRepository->getRolePermissions($roleId);

        return view('dashboard.role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $this->roleRepository->syncPermissions($roleId, $request->permission);

        return redirect()->back()->with('status','Permissions added to role');
    }
}
