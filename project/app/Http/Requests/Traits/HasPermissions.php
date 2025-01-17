<?php

namespace app\Http\Requests\Traits;

use app\Enum\PermissionEnum;
use app\Enum\RoleEnum;

trait HasPermissions
{
    public function hasPermission(RoleEnum $role, PermissionEnum $permission)
    {
        return auth()->user()?->hasRole($role->value) && auth()->user()->can($permission->value) ?? false;
    }
}
