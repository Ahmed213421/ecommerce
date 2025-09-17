<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $users = $this->adminRepository->getAll();
        return view('dashboard.role-permission.user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('dashboard.role-permission.user.create', ['roles' => $roles]);
    }

    public function store(AdminStoreRequest $request)
    {
        $user = $this->adminRepository->create($request->all());
        $this->adminRepository->syncRoles($user, $request->roles);

        return redirect()->route('admin.users.index')->with('status', 'User created successfully with roles');
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
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ];

        if (!empty($request->password)) {
            $data['password'] = $request->password;
        }

        $this->adminRepository->update($user->id, $data);
        $this->adminRepository->syncRoles($user, $request->roles);

        if($request->status == 'unactive'){
            if (auth('admin')->check() && auth('admin')->user()->email === $request->email) {
                auth('admin')->logout();
            }
        }

        return redirect()->route('admin.users.index')->with('status', 'User Updated Successfully with roles');
    }

    public function destroy($userId)
    {
        $this->adminRepository->delete($userId);
        return redirect()->route('admin.users.index')->with('status', 'User Delete Successfully');
    }
}
