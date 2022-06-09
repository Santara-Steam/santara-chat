<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    public function render($request)
    {
        return redirect('/')->with(['message' => "Unauthorized"]);
    }
}
