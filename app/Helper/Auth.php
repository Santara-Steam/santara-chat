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

    public static function check(): bool
    {
        return (bool) self::User();
    }

    public static function role()
    {
        return self::User()->roles;
    }

    public static function isAdmin()
    {
        return self::User()->isAdmin();
    }

}
