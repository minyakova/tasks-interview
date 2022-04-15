<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Input\CreateUserDto;
use App\Domain\Contract\UserServiceInterface;
use Exception;
use Twig;

class HomeController extends AbstractController
{
    //Сделать авторизацию
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

    public function actionIndex():void
    {

          if($_POST['form-id']) {

                try{
                    $dto = CreateUserDto::fromArray($_POST);
                    $this->userService->userAuthorization($dto);

                    header("Location: /users");
                    exit();
                }catch(Exception $e){
                    header("HTTP/1.1 401 Unauthorized");
                    echo  $e->getMessage();
                }

          }

       echo $this->twig->render('index.html');

    }

    public function actionResult():void
    {
        //echo '777';
        //echo $this->twig->render('users.html');
        //header("HTTP/1.1 201 OK");

    }

}