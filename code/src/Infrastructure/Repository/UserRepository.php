<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Input\CreateUserDto;
use App\Application\Output\UserIsCreatedDto;
use App\Domain\Contract\UserFactoryInterface;
use App\Domain\Contract\UserRepositoryInterface;
use App\Domain\Entity\User;
use Exception;


class UserRepository implements UserRepositoryInterface
{
    private array $users;
    private string $file;
    private UserFactoryInterface $userFactory;

    public function __construct(UserFactoryInterface $userFactory)
    {
        $this->file = file_get_contents(ROOT . '/src/Infrastructure/DB/data.json');
        $this->users = json_decode($this->file, true);
        $this->userFactory = $userFactory;
    }

    public function selectAllUsers(): UserIsCreatedDto
    {
        UserIsCreatedDto::setUsers($this->users);

        if (empty($this->users)) {
            throw new Exception('Пользователи отсутствуют');
        }

        return new UserIsCreatedDto();
    }

    public function insertUser(CreateUserDto $dto): UserIsCreatedDto
    {

            unset($this->file);

            $user = $this->userFactory->build($dto);

            $this->users[] = (array) $user;
            file_get_contents(ROOT . '/src/Infrastructure/DB/data.json',json_encode($this->users));

            $resultUser = new UserIsCreatedDto();
            $resultUser::setLogin($user->getLogin());

            return $resultUser;

    }

    public function selectUser(CreateUserDto $dto): bool
    {

        $user = $this->userFactory->build($dto);

        $msg1 = 'Пользователь с данным логином отсутствует';
        $msg2 = 'Пароль не верный';

        foreach ($this->users as $key => $value) {
            if(in_array($user->getLogin(),$value)){
               $msg1 = '';
               if($value['pass'] === $user->getPass()){
                   $msg2 = '';
               }
            }
        }

        if($msg1 !== ""){ throw new Exception($msg1); }

        if($msg2 !== ""){ throw new Exception($msg2); }

        return true;
    }
}