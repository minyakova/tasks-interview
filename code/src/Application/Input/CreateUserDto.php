<?php
declare(strict_types=1);

class CreateUserDto
{
    //Сделать валидацию
    static public string $firstname;
    static public string $lastname;
    static public string $age;
    static public string $login;
    static public string $pass;

    static function fromArray(?array $arrayFromPost):CreateUserDto
    {
        if(empty($bodyJson)){
            throw new Exception('Данные для создания запроса отсутствуют!');
        }

        self::$firstname = $bodyJson['firstname'];
        self::$lastname = $bodyJson['lastname'];
        self::$age = $bodyJson['age'];
        self::$login = $bodyJson['login'];
        self::$pass = $bodyJson['pass'];

        return new CreateUserDto();
    }

}