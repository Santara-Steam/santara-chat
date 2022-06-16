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
        $header = request()->header();

        if (!array_key_exists('email', $header) || !array_key_exists('password', $header)) {
            throw new NotFoundException('Email & password header must be filled');
        }

        $user = User::where("email", '=', $header["email"][0])->first();
        $check = Hash::check($header['password'][0], $user->password);

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
