<?php
declare(strict_types=1);

namespace App\Application\Output;

class UserIsCreatedDto
{
    static private array $users;
    static private string $login;

    static function setUsers(array $users): void
    {
        self::$users = $users;
    }

    static function getUsers(): array
    {
        return self::$users;
    }

    static function setLogin(string $login): void
    {
        self::$login = $login;
    }

    static function getLogin():string
    {
        return self::$login;
    }
}