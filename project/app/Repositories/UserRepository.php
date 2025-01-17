<?php

namespace app\Repositories;

use app\Dto\Admin\UserDto;
use app\Enum\RoleEnum;
use App\Models\User;
use app\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    protected Builder $query;

    public function __construct()
    {
        $this->query = User::query();
    }

    public function getAll(): Collection
    {
        return $this->query->get();
    }

    public function findById(int $id): ?User
    {
        return $this->query->with('roles')->findOrFail($id);
    }

    public function create(UserDto $userDto): ?User
    {
        $user = DB::transaction(function () use ($userDto) {
            $user = $this->query->create($userDto->toArray());
            $user->assignRole($userDto->role);
            return $user;
        });

        return $user ?: null;
    }

    public function update(int $id, UserDto $userDto): bool
    {
        return DB::transaction(function () use ($userDto, $id) {
            $user = $this->findById($id);

            if (!$user) {
                return false;
            }

            $user->fill($userDto->toArray());

            if (!$user->save()) {
                return false;
            }

            $user->syncRoles([$userDto->role]);
            return true;
        });

    }

    public function delete(int $id): bool
    {
        return (bool)$this->query->whereId($id)->delete();
    }

    public function getByRole(RoleEnum $roleEnum): Collection
    {
        return $this->query->role($roleEnum->value)->get();
    }
}
