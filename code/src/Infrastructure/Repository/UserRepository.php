<?php
declare(strict_types=1);

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
        

    }

    public function selectUser(CreateUserDto $dto):User
    {

    }
}