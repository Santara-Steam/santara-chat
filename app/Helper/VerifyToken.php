<?php

namespace App\Helper;

use App\Exceptions\UnauthorizedException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VerifyToken
{
    public static function check()
    {
        $session = session()->all();

        return self::attempt($session);
    }

    /**
     * @throws UnauthorizedException
     */
    protected static function attempt($session)
    {
        if (empty($session['userId']) || empty($session["email"]) || empty($session["auth"])){
            throw new UnauthorizedException('Unauthorized');
        }

        $user = self::getUser($session['userId']);

        if (!$user) {
            return redirect('/')->with(['message' => 'please go to santara for authorize session']);
        }

        $verified = self::verifyUser($user, $session);

        if (!$verified) {
            return redirect('/')->with(['message' => 'credentials not match']);
        }

        return true;
    }

    protected static function getUser($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return false;
        }

        return $user;
    }

    protected static function verifyUser($user, $session)
    {
        if (Hash::check($session['auth'], $user->password)) {
            return true;
        }

        return false;
    }

}
