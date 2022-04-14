<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

class HomeController
{
    //Сделать авторизацию
    private UserServiceInterface $userService;

    public function construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function setService(UserServiceInterface $userService):void
    {
        $this->userService = $userService;
    }

    public function actionIndex()
    {
       /*
        $dto = CreateUserDto::fromArray($_POST);
        $result = $this->userService->userAuthorization($dto);

        if(!$result) {
            throw new \Exception("Пользователь не найден! Введите данные правильно");
            header("HTTP/1.1 401 Unauthorized");
        }

        //Пользователь не найден! Введите данные правильно
        //Пароль не верный, повторите ввод пароля
        header("HTTP/1.1 200 OK");
        */
    }


}