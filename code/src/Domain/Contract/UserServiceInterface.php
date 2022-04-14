<?php
declare(strict_types=1);

interface UserServiceInterface
{
    public function getUsers();
    public function addUser(CreateUserDto $dto):UserIsCreatedDto;
    public function userAuthorization(CreateUserDto $dto):UserIsCreatedDto;
}