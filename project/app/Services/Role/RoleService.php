<?php

namespace app\Services\Role;

use app\Dto\Role\RolePermissionDto;
use app\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    public function __construct(protected RoleRepository $roleRepository) {}

    public function all(): Collection
    {
        return $this->roleRepository->all();
    }

    public function allPermissions(): Collection
    {
        return $this->roleRepository->allPermissions();
    }

    public function update(RolePermissionDto $rolePermissionDto): array
    {
        return $this->roleRepository->updatePermissions($rolePermissionDto);
    }
}
