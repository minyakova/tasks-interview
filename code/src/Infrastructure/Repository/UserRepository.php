<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Input\CreateUserDto;
use App\Domain\Contract\UserRepositoryInterface;
use App\Domain\Entity\User;
use Exception;


class UserRepository implements UserRepositoryInterface

{


    public function __construct()
    {

    }

    public function selectAllUsers()
    {

    }

    public function insertUser(CreateUserDto $dto):User
    {
        $user = $this->userFactory->build(
            $dto::$firstname,
            $dto::$lastname,
            $dto::$age,
            $dto::$login,
            $dto::$pass
        );
        
        return $user;
    }

    public function selectUser(CreateUserDto $dto):bool
    {
        //По архитектуре не верно, надо переделать
        return (new User($dto))->select();

        //$login = $user->getLogin();
        //$pass = $user->getPass();


    }
}