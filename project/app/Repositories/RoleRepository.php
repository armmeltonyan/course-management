<?php

namespace app\Repositories;

use app\Dto\Role\RolePermissionDto;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function all(): Collection
    {
        return Role::with('permissions')->get();
    }

    public function allPermissions(): Collection
    {
        return Permission::all();
    }

    public function updatePermissions(RolePermissionDto $rolePermissionDto): array
    {
        $role = Role::findOrFail($rolePermissionDto->roleId);

        return $role->permissions()->sync($rolePermissionDto->permissions);
    }
}
