<?php
declare(strict_types=1);

namespace App\Domain\Contract;

use App\Application\Input\CreateUserDto;
use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function selectAllUsers();
    public function insertUser(CreateUserDto $dto):User;
    public function selectUser(CreateUserDto $dto):bool;

}