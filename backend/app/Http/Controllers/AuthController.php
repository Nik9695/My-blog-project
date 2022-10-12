<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)]
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['code' => 403, 'message' => 'invalid credentials'], 403);
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();

        return $user->createToken('auth_token')->plainTextToken;
    }
}
