<?php
declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Application\Input\CreateUserDto;
use App\Domain\Contract\UserFactoryInterface;
use App\Domain\Entity\User;
use Exception;

class UserFactory implements UserFactoryInterface
{
    private User $user;

    public function build(
        ?CreateUserDto $dto
    ):User
    {
        try{
            $this->user = new User($dto);
        }catch(Exception $e){
            echo $e->getMessage();
        }

        return $this->user;
    }
}