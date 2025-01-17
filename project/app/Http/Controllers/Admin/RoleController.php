<?php

namespace App\Http\Controllers\Admin;

use app\Dto\Role\RolePermissionDto;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Role\GetPermissionPageRequest;
use App\Http\Requests\Role\PermissionUpdateRequest;
use app\Services\Role\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RoleController extends BaseController
{
    public function __construct(
        protected readonly RoleService $roleService
    ) {}

    public function index(GetPermissionPageRequest $request): View
    {
        $roles = $this->roleService->all();
        $permissions = $this->roleService->allPermissions();

        return self::sendView('admin.roles.index',['roles' => $roles,'permissions' => $permissions]);
    }

    /**
     * @throws UnknownProperties
     */
    public function update(PermissionUpdateRequest $request): RedirectResponse
    {
        $rolePermissionDto = new RolePermissionDto(
            roleId: $request->role_id,
            permissions: $request->permissions
        );

        return $this->roleService->update($rolePermissionDto)
            ? self::sendResponse('admin.manage.roles','Permissions updated successfully!')
            : self::sendError('error');
    }
}
