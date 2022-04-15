<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Domain\Contract\UserServiceInterface;

class UserController extends AbstractController
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

    public function actionGetUsers():void
    {
        //$users = $this->userService->getUsers();
        //Вывод


        echo $this->twig->render('users.html');

    }

    public function actionSingUp():void
    {
        //$result = $this->userService->addUser($dtoUser);
        echo '555';
    }

}