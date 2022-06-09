<?php

namespace App\Helper;

use App\Models\User;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Auth
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function ID(){
        return session()->get('userId');
    }

    public static function User(){
        return User::find(self::ID());
    }
}
