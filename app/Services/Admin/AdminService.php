<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Contracts\AdminContract;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminService
{
    protected $adminRepository;

    public function __construct(AdminContract $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getAllAdmins()
    {
        return $this->adminRepository->getAll();
    }

    public function createAdmin(array $data, array $roles = [])
    {
        $user = $this->adminRepository->create($data);
        $this->adminRepository->syncRoles($user, $roles);
        return $user;
    }

    public function updateAdmin(Admin $user, array $data, array $roles = [])
    {
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = $data['password'];
        }

        $this->adminRepository->update($user->id, $updateData);
        $this->adminRepository->syncRoles($user, $roles);

        if ($data['status'] == 'unactive') {
            if (auth('admin')->check() && auth('admin')->user()->email === $data['email']) {
                auth('admin')->logout();
            }
        }

        return $user;
    }

    public function deleteAdmin($userId)
    {
        return $this->adminRepository->delete($userId);
    }
}
