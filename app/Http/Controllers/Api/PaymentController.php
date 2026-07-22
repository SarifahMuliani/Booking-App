<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * List all payment accounts.
     *
     * GET /api/payments
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data'    => Payment::all(),
        ]);
    }

    /**
     * Add a payment account (Admin only).
     *
     * POST /api/payments
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_rek'   => 'required|string|max:255',
            'nama_rek' => 'required|string|max:255',
        ]);

        $payment = Payment::create($request->only(['no_rek', 'nama_rek']));

        return response()->json([
            'success' => true,
            'message' => 'Payment berhasil ditambahkan',
            'data'    => $payment,
        ], 201);
    }

    /**
     * Update a payment account (Admin only).
     *
     * PUT /api/payments/{id}
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'no_rek'   => 'sometimes|string|max:255',
            'nama_rek' => 'sometimes|string|max:255',
        ]);

        $payment->update($request->only(['no_rek', 'nama_rek']));

        return response()->json([
            'success' => true,
            'message' => 'Payment berhasil diperbarui',
            'data'    => $payment->fresh(),
        ]);
    }

    /**
     * Delete a payment account (Admin only).
     *
     * DELETE /api/payments/{id}
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment tidak ditemukan',
            ], 404);
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Payment berhasil dihapus',
        ]);
    }
}
