<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * POST /api/register
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'        => $request->name,
            'username'    => $request->username,
            'password'    => Hash::make($request->password),
            'level'       => 'Penyewa',
            'status_user' => 'Aktif',
        ]);

        // Create empty datauser row (matches web registration logic)
        DataUser::create([
            'user_id' => $user->id,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data'    => [
                'user'  => $user->load('dataUser'),
                'token' => $token,
            ],
        ], 201);
    }

    /**
     * Login with username and password.
     *
     * POST /api/login
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['Username atau password salah.'],
            ]);
        }

        if ($user->status_user !== 'Aktif') {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda tidak aktif. Hubungi admin.',
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data'    => [
                'user'  => $user->load('dataUser'),
                'token' => $token,
            ],
        ]);
    }

    /**
     * Logout (revoke current token).
     *
     * POST /api/logout
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

    /**
     * Get authenticated user info.
     *
     * GET /api/me
     */
    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'data'    => $request->user()->load('dataUser'),
        ]);
    }
}
