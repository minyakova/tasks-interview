<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use App\Application\Input\CreateUserDto;
use Exception;

class User
{
    private string $login;
    private string $pass;
    private string $lastname;
    private string $firstname;
    private int $age;

    public function __construct(CreateUserDto $dto)
    {

        $this->login = $this->validateLogin($dto::$login);
        $this->pass = $this->validatePass($dto::$pass);

        if (!empty($this->lastname)) {
            $this->lastname = $this->validateLastname($dto::$lastname);
        }

        if (!empty($this->firstname)) {
            $this->firstname =  $this->validateFirstname($dto::$firstname);
        }

        if (!empty($this->age)) {
            $this->age = $this->validateAge($dto::$age);
        }

    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }


    public function validateLogin(string $login): string
    {
        $this->isEmptyInput($login, 'логин');

        $pattern = '/^[a-z0-9-_]{2,20}+$/i';

        if (!preg_match($pattern,$login)) {
            throw new Exception('Для логина используйте латинские буквы, и цифры, знаки -_. Длина до 20 символов');
        }

        return $login;
    }

    public function validatePass(string $pass): string
    {
        $this->isEmptyInput($pass, 'пароль');

        $pattern = '/^[a-z0-9#@]{2,20}+$/i';

        if (!preg_match($pattern,$pass)) {
            throw new Exception('Для пароля используйте латинские буквы и цифры, знаки #@. Длина до 20 символов');
        }

        return $pass;
    }

    public function validateFirstname(string $firstname): string
    {
        $this->isEmptyInput($firstname, 'имя');

        $pattern = '/^[а-яёa-z0-9-_]{2,20}+$/i';

        if (!preg_match($pattern,$firstname)) {
            throw new Exception('Для имени используйте латинские буквы,кириллицу.  Длина до 20 символов');
        }

        return $firstname;
    }

    public function validateLastname(string $lastname): string
    {
        $this->isEmptyInput($lastname, 'фамилия');

        $pattern = '/^[а-яёa-z0-9-_]{2,20}+$/i';

        if (!preg_match($pattern,$lastname)) {
            throw new Exception('Для фамилии используйте латинские буквы,кириллицу. Длина до 20 символов');
        }

        return $lastname;
    }

    public function validateAge(string $age): int
    {
        $this->isEmptyInput($age, 'возраст');

        $age = (int)$age;

        if ($age<=0 || $age>=120) {
            throw new Exception('Укажите возраст верно!');
        }


        return $age;
    }

    public function isEmptyInput(string $nameInput,string $strName):void
    {
        if (empty($nameInput)) {
            throw new Exception("Поле {$strName} не заполнено");
        }
    }
}