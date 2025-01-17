<?php

namespace app\Services\User;

use app\Dto\Admin\UserDto;
use app\Enum\RoleEnum;
use App\Models\User;
use app\Repositories\UserRepository;
use Illuminate\Support\Collection;

class UserService
{
    //todo change to interface and bind in provider
    public function __construct(protected UserRepository $userRepository) {}

    public function all(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function create(UserDto $userDto): ?User
    {
        return $this->userRepository->create($userDto);
    }

    public function update(int $id, UserDto $userDto): bool
    {
        return $this->userRepository->update($id, $userDto);
    }

    public function delete(int $id): bool
    {
        return $this->userRepository->delete($id);
    }

    public function getByRole(RoleEnum $roleEnum): Collection
    {
        return $this->userRepository->getByRole($roleEnum);
    }

    public function getById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }
}
