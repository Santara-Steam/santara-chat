<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;


class SsoController extends Controller
{
    public function authorizes(Request $request)
    {
        session()->put($request->all());

        $user = User::find($request->get('userId'));

        $result = true;

        if (!$user) {
            User::create([
                'id' => $request->get('userId'),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('auth')),
                'is_active' => true,
                'email_verified_at' => now()->format("Y-m-d H:i:s")
            ]);
        } else {
            $result = Hash::check($request->get('auth'), $user->password);
        }

        if (!$result) {
            throw new UnauthorizedException();
        }

        return redirect('/conversations');
    }
}
