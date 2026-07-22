<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Get app profile info.
     *
     * GET /api/profile
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data'    => Profil::all(),
        ]);
    }

    /**
     * Update app profile (Admin only).
     *
     * PUT /api/profile/{id}
     */
    public function update(Request $request, $id)
    {
        $profil = Profil::find($id);

        if (!$profil) {
            return response()->json([
                'success' => false,
                'message' => 'Profil tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'nama_profil' => 'sometimes|string|max:255',
            'jenis_apk'   => 'sometimes|string|max:255',
            'lokasi'       => 'sometimes|string|max:255',
            'no_profil'    => 'sometimes|string|max:255',
        ]);

        $profil->update($request->only(['nama_profil', 'jenis_apk', 'lokasi', 'no_profil']));

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'data'    => $profil->fresh(),
        ]);
    }
}
