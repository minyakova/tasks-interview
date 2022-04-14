<?php
declare(strict_types=1);

interface UserRepositoryInterface
{
    public function selectAllUsers();
    public function insertUser(CreateUserDto $dto):User;
    public function selectUser(CreateUserDto $dto):User;

}