<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use App\Application\Input\CreateUserDto;
use Exception;

class User
{
    private string $login;
    private string $pass;

    public function __construct(CreateUserDto $dto)
    {
        $this->login = $dto::$login;
        $this->pass = $dto::$pass;

    }

    public function select():?bool
    {

        $userList = file_get_contents(ROOT.'/src/Infrastructure/DB/data.json');
        $users = json_decode($userList,true);

        if(isset($users[$this->login])){
            if($users[$this->login] === $this->pass){
                return true;
            }else{
                throw new Exception('Пароль не верный');
            }
        }else{
            throw new Exception('Пользователь с данным логином отсутствует');
        }
    }

}