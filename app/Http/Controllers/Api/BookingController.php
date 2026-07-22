<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataSewa;
use App\Models\NamaLapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * List bookings.
     * - Admin: sees all bookings
     * - Penyewa: sees only their own bookings
     *
     * GET /api/bookings
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->level === 'Admin') {
            $bookings = DataSewa::with(['user', 'lapangan'])->get();
        } else {
            $bookings = DataSewa::with('lapangan')
                ->where('id_user', $user->id)
                ->get();
        }

        return response()->json([
            'success' => true,
            'data'    => $bookings,
        ]);
    }

    /**
     * Create a new booking (checks time conflict).
     *
     * POST /api/bookings
     */
    public function store(Request $request)
    {
        $request->validate([
            'lap_id'      => 'required|integer|exists:nama_lapangan,id_lapangan',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required|string',
            'jam_selesai'  => 'required|string',
        ]);

        $awal = $request->jam_mulai;
        $selesai = $request->jam_selesai;

        // Check for time conflicts (same logic as web UserController)
        $conflict = DataSewa::where('lap_id', $request->lap_id)
            ->where('keterangan', 'Aktif')
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($awal, $selesai) {
                $query->whereBetween('jam_mulai', [$awal, $selesai])
                    ->orWhereBetween('jam_selesai', [$awal, $selesai]);
            })
            ->first();

        if ($conflict) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal bentrok dengan booking lain pada waktu tersebut.',
            ], 409);
        }

        $jatuhtempo = date('H:i:s', strtotime("+30 minutes", strtotime(date('H:i:s'))));

        $booking = DataSewa::create([
            'id_user'     => $request->user()->id,
            'lap_id'      => $request->lap_id,
            'tanggal'     => $request->tanggal,
            'tempo'       => $jatuhtempo,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keterangan'  => '-',
            'konfirmasi'  => 'Belum di Konfirmasi',
            'bukti_tf'    => '-',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibuat',
            'data'    => $booking->load('lapangan'),
        ], 201);
    }

    /**
     * Get booking detail.
     *
     * GET /api/bookings/{id}
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $booking = DataSewa::with(['user', 'user.dataUser', 'lapangan'])->find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan',
            ], 404);
        }

        // Non-admin can only see their own bookings
        if ($user->level !== 'Admin' && $booking->id_user !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data'    => $booking,
        ]);
    }

    /**
     * Delete a booking (own booking only, or Admin).
     *
     * DELETE /api/bookings/{id}
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $booking = DataSewa::find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan',
            ], 404);
        }

        if ($user->level !== 'Admin' && $booking->id_user !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak',
            ], 403);
        }

        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dihapus',
        ]);
    }

    /**
     * Upload transfer proof for a booking.
     *
     * POST /api/bookings/{id}/upload-proof
     */
    public function uploadProof(Request $request, $id)
    {
        $user = $request->user();
        $booking = DataSewa::find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan',
            ], 404);
        }

        if ($user->level !== 'Admin' && $booking->id_user !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak',
            ], 403);
        }

        $request->validate([
            'gambar' => 'required|image',
        ]);

        $file = $request->file('gambar');
        $name = $file->getClientOriginalName();
        $namaFileBaru = uniqid() . $name;
        $file->move(base_path() . "/public/upload", $namaFileBaru);

        $booking->update([
            'bukti_tf'    => $namaFileBaru,
            'keterangan'  => 'Sedang di Cek',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bukti transfer berhasil diupload',
            'data'    => $booking->fresh(),
        ]);
    }

    /**
     * Update booking status (Admin only).
     *
     * PUT /api/bookings/{id}/status
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = DataSewa::find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'keterangan' => 'sometimes|string|max:255',
            'konfirmasi' => 'sometimes|string|max:255',
        ]);

        $data = [];
        if ($request->has('keterangan')) {
            $data['keterangan'] = $request->keterangan;
        }
        if ($request->has('konfirmasi')) {
            $data['konfirmasi'] = $request->konfirmasi;
        }

        // Shortcut: if confirming, also set keterangan to Aktif (matches web logic)
        if ($request->konfirmasi === 'Sudah di Konfirmasi' && !$request->has('keterangan')) {
            $data['keterangan'] = 'Aktif';
        }

        $booking->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Status booking berhasil diperbarui',
            'data'    => $booking->fresh(),
        ]);
    }

    /**
     * View active bookings schedule for a field (public).
     *
     * GET /api/fields/{id}/schedule
     */
    public function schedule($id)
    {
        $field = NamaLapangan::find($id);

        if (!$field) {
            return response()->json([
                'success' => false,
                'message' => 'Lapangan tidak ditemukan',
            ], 404);
        }

        $bookings = DataSewa::with('user:id,name')
            ->where('lap_id', $id)
            ->where('keterangan', 'Aktif')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $bookings,
        ]);
    }
}
