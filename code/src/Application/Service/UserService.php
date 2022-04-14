<?php
declare(strict_types=1);

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function construct(UserRepositoryInterface $userRepository)
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

    public function userAuthorization(CreateUserDto $dto):UserIsCreatedDto
    {
        //return $this->userRepository->selectUser($dto);
    }
}