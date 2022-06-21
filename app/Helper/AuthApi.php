<?php

namespace App\Helper;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthApi
{
    /**
     * @throws UnauthorizedException
     * @throws NotFoundException
     */
    public static function user()
    {
        $header = session()->all();

        if (!array_key_exists('email', $header) || !array_key_exists('auth', $header)) {
            throw new NotFoundException('Email & password header must be filled');
        }

        $user = User::where("email", '=', $header["email"])->first();
        $check = Hash::check($header['auth'], $user->password);

        if (!$check) {
             throw new NotFoundException('User not found');
        }

        return $user;
    }

    public static function getAuthID()
    {
        return self::user()->id;
    }
}
