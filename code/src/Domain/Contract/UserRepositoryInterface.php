<?php
declare(strict_types=1);

namespace App\Domain\Contract;

use App\Application\Input\CreateUserDto;
use App\Application\Output\UserIsCreatedDto;
use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function selectAllUsers():UserIsCreatedDto;
    public function insertUser(CreateUserDto $dto):UserIsCreatedDto;
    public function selectUser(CreateUserDto $dto):bool;

}