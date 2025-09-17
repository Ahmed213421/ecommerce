<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Interfaces\PermissionRepositoryInterface;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        // $this->middleware('permission:view-permission,admin', ['only' => ['index']]);
        // $this->middleware('permission:create-permission,admin', ['only' => ['create','store']]);
        // $this->middleware('permission:update-permission,admin', ['only' => ['update','edit']]);
        // $this->middleware('permission:delete-permission,admin', ['only' => ['destroy']]);
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->getAll();
        return view('dashboard.role-permission.permission.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('dashboard.role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        $this->permissionRepository->create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.permissions.index')->with('status','Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        return view('dashboard.role-permission.permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $this->permissionRepository->update($permission->id, [
            'name' => $request->name
        ]);

        return redirect()->route('admin.permissions.index')->with('status','Permission Updated Successfully');
    }

    public function destroy($permissionId)
    {
        $this->permissionRepository->delete($permissionId);
        return redirect()->route('admin.permissions.index')->with('status','Permission Deleted Successfully');
    }
}
