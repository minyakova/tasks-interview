<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

class UserController
{
    //Создать пользователя
    //Вывести список пользователей

    private UserServiceInterface $userService;

    public function construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    public function setService(UserServiceInterface $userService):void
    {
        $this->userService = $userService;
    }

    public function actionGetUsers()
    {
        //$users = $this->userService->getUsers();
        //Вывод

    }

    public function actionSingUp()
    {
        //$result = $this->userService->addUser($dtoUser);
    }

}