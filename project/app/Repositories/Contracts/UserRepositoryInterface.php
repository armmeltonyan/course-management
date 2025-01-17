<?php

namespace app\Repositories\Contracts;

use app\Dto\Admin\UserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?User;
    public function create(UserDto $userDto): ?User;
    public function update(int $id, UserDto $userDto): bool;
    public function delete(int $id): bool;
}
