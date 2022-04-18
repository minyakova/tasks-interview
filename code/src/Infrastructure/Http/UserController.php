<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Input\CreateUserDto;
use App\Application\Output\UserIsCreatedDto;
use App\Domain\Contract\UserServiceInterface;
use Exception;

class UserController extends AbstractController
{
    //Создать пользователя
    //Вывести список пользователей

    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function setService(UserServiceInterface $userService):void
    {
        $this->userService = $userService;
    }

    public function actionGetUsers():void
    {
        try{
            $dto = $this->userService->getUsers();
            $users = $dto::getUsers();

            header("HTTP/1.1 200 OK");
            echo $this->twig->render('users.html',['users'=>$users]);
        }catch(Exception $e){
            header("HTTP/1.1 401 Unauthorized");
            echo  $e->getMessage();
        }

    }

    public function actionSingUp():void
    {
        if($_POST['form-id']=='form-registration') {

            try{
                $dto = CreateUserDto::fromArray($_POST);
                $resultDto = $this->userService->addUser($dto);

                header("Location: /users");
                exit();
            }catch(Exception $e){
                header("HTTP/1.1 401 Unauthorized");
                echo  $e->getMessage();
            }

        }

        echo $this->twig->render('singup.html');
    }

}