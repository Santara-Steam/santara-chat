<?php

namespace App\Http\Controllers;

use App\Helper\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;

class BroadcastController extends Controller
{
    public function authenticate(Request $request)
    {

        if ($request->hasSession()) {
            $request->session()->reflash();
        }
        $user = Auth::User();
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return Broadcast::auth($request);
    }
}
