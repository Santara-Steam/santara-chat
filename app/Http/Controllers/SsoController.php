<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SsoController extends Controller
{
    const LOGIN_WEB = 'login_web_3dc7a913ef5fd4b890ecabe3487085573e16cf82';
    /**
     */
    public function sso(Request $request): JsonResponse
    {
//        $session = $request->get('session');

//        $request->session()->flush();
//        $request->session()->start();
//        $request->session()->put(array_merge($session,  [self::LOGIN_WEB => $session["user_id"]]));
//        $request->session()->save();

//        session()->start();
//

//        session([
//            self::LOGIN_WEB => $request->get("userId"),
//            "auth" => [
//                "password_confirmed_at" => now()->timestamp
//            ]
//        ]);
////        session()->migrate(true);
//        session()->save();

//        Session::setId();
//        Session::flush();

//        Auth::loginUsingId($request->get("userId"));
        Auth::attempt(["email" =>$request->get("email"),
            "password" => $request->get("password")]);
        return response()->json([
            'success' => session()->all(),
            's' => \auth()->user()
        ]);
    }
}
