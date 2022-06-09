<?php

namespace App\Helper;

use App\Models\User;

class Internationalization
{
    public static function getCurrentLanguageName(){
        return User::whereId(Auth::ID())->first()->language;
    }
}
