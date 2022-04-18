<?php
declare(strict_types=1);

namespace App\Domain\Contract;

use App\Application\Input\CreateUserDto;
use App\Domain\Entity\User;

interface UserFactoryInterface
{
    public function build(CreateUserDto $dto):User;

}