<?php
declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Input\CreateUserDto;
use App\Domain\Contract\UserRepositoryInterface;
use App\Domain\Contract\UserServiceInterface;
use UserIsCreatedDto;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function setService(UserRepositoryInterface $userRepository):void
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        return $this->userRepository->selectAllUsers();
    }

    public function addUser(CreateUserDto $dto):UserIsCreatedDto
    {
        //return $this->userRepository->insertUser($dto);
    }

    public function userAuthorization(CreateUserDto $dto):bool
    {
        return $this->userRepository->selectUser($dto);
    }
}