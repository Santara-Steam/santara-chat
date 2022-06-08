<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SsoController extends Controller
{
    public function sso(Request $request): JsonResponse
    {
        $session = $request->get("session");

        session()->invalidate();
        session()->put($session);
        session()->save();

        return response()->json([
            'success' => "OK",
        ]);
    }
}
