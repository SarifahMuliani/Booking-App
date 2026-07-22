<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDataController extends Controller
{
    /**
     * Get authenticated user's data (user + datauser).
     *
     * GET /api/user-data
     */
    public function show(Request $request)
    {
        $user = $request->user()->load('dataUser');

        return response()->json([
            'success' => true,
            'data'    => $user,
        ]);
    }

    /**
     * Update authenticated user's profile data.
     *
     * PUT /api/user-data
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'            => 'sometimes|string|max:255',
            'username'        => 'sometimes|string|max:255|unique:users,username,' . $user->id,
            'password'        => 'sometimes|string|min:6|confirmed',
            'email'           => 'sometimes|nullable|string|email|max:255',
            'no_telp'         => 'sometimes|nullable|string|max:255',
            'jenis_kelamin'   => 'sometimes|nullable|string|max:255',
            'ktp'             => 'sometimes|nullable|string|max:255',
            'alamat_penyewa'  => 'sometimes|nullable|string|max:255',
        ]);

        // Update users table
        $userData = [];
        if ($request->has('name')) {
            $userData['name'] = $request->name;
        }
        if ($request->has('username')) {
            $userData['username'] = $request->username;
        }
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        if (!empty($userData)) {
            $user->update($userData);
        }

        // Update datauser table
        $dataUserFields = $request->only(['email', 'no_telp', 'jenis_kelamin', 'ktp', 'alamat_penyewa']);
        if (!empty($dataUserFields)) {
            DataUser::where('user_id', $user->id)->update($dataUserFields);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data'    => $user->fresh()->load('dataUser'),
        ]);
    }

    /**
     * List all users with their data (Admin only).
     *
     * GET /api/users
     */
    public function listUsers()
    {
        $users = User::with('dataUser')
            ->where('level', 'Penyewa')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $users,
        ]);
    }

    /**
     * Toggle user status Aktif/Non-Aktif (Admin only).
     *
     * PUT /api/users/{id}/toggle-status
     */
    public function toggleStatus($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        $newStatus = $user->status_user === 'Aktif' ? 'Non-Aktif' : 'Aktif';
        $user->update(['status_user' => $newStatus]);

        return response()->json([
            'success' => true,
            'message' => "Status user berhasil diubah menjadi {$newStatus}",
            'data'    => $user->fresh(),
        ]);
    }
}
