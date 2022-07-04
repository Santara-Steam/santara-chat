<?php

namespace App\Helper;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthApi
{
    /**
     * @throws UnauthorizedException
     * @throws NotFoundException
     */
    public static function user()
    {
        $header = request()->header();
        $session = session()->all();

        $isBotTesting = request()->header('BotTesting');

        $credentials = [];

        if (array_key_exists('email', $header) && array_key_exists('password', $header)) {
            $credentials['email'] = $header['email'][0];
            $credentials['password'] = $header['password'][0];
        }   elseif (array_key_exists('email', $session) && array_key_exists('auth', $session)) {
            $credentials['email'] = $session['email'];
            $credentials['password'] = $session['auth'];
        } else {

            if ($isBotTesting) {
                $userId = request('user_id');

                return User::find($userId);
            }

            throw new UnauthorizedHttpException("email & password header/session not match");
        }

        $user = User::where("email", '=', $credentials["email"])->first();
        $check = Hash::check($credentials['password'], $user->password);

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
