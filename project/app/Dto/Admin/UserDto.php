<?php

namespace app\Dto\Admin;

use Spatie\DataTransferObject\DataTransferObject;

class UserDto extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $password;
    public string $role;
}
