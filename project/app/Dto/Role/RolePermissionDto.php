<?php

namespace app\Dto\Role;

use Spatie\DataTransferObject\DataTransferObject;

class RolePermissionDto extends DataTransferObject
{
    public int $roleId;
    public array $permissions;
}
