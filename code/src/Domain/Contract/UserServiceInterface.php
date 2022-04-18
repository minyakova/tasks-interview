<?php
declare(strict_types=1);

namespace App\Domain\Contract;

use App\Application\Input\CreateUserDto;
use App\Application\Output\UserIsCreatedDto;


interface UserServiceInterface
{
    public function getUsers();
    public function addUser(CreateUserDto $dto):UserIsCreatedDto;
    public function userAuthorization(CreateUserDto $dto): bool;
}