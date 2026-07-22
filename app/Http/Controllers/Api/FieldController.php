<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NamaLapangan;
use App\Models\ImageLapangan;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * List all fields.
     *
     * GET /api/fields
     */
    public function index()
    {
        $fields = NamaLapangan::all();

        return response()->json([
            'success' => true,
            'data'    => $fields,
        ]);
    }

    /**
     * Get a single field with its images.
     *
     * GET /api/fields/{id}
     */
    public function show($id)
    {
        $field = NamaLapangan::with('images')->find($id);

        if (!$field) {
            return response()->json([
                'success' => false,
                'message' => 'Lapangan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $field,
        ]);
    }

    /**
     * Create a new field (Admin only).
     *
     * POST /api/fields
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lap'      => 'required|string|max:255',
            'nama_jenis'    => 'nullable|string|max:250',
            'harga'         => 'required|integer',
            'gambar'        => 'required|image',
            'kegiatan'      => 'required|string|max:255',
            'det_lapangan'  => 'required|string|max:255',
            'tgl'           => 'nullable|date',
        ]);

        $file = $request->file('gambar');
        $namafoto = md5($file->getClientOriginalName());
        $path = $file->move(base_path() . "/public/gambar", $namafoto);

        $field = NamaLapangan::create([
            'nama_lap'     => $request->nama_lap,
            'nama_jenis'   => $request->nama_jenis,
            'harga'        => $request->harga,
            'gambar'       => $namafoto,
            'kegiatan'     => $request->kegiatan,
            'det_lapangan' => $request->det_lapangan,
            'tgl'          => $request->tgl,
            'path'         => $path,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lapangan berhasil ditambahkan',
            'data'    => $field,
        ], 201);
    }

    /**
     * Update a field (Admin only).
     *
     * PUT /api/fields/{id}
     */
    public function update(Request $request, $id)
    {
        $field = NamaLapangan::find($id);

        if (!$field) {
            return response()->json([
                'success' => false,
                'message' => 'Lapangan tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'nama_lap'     => 'sometimes|string|max:255',
            'nama_jenis'   => 'sometimes|string|max:250',
            'harga'        => 'sometimes|integer',
            'gambar'       => 'sometimes|image',
            'kegiatan'     => 'sometimes|string|max:255',
            'det_lapangan' => 'sometimes|string|max:255',
            'tgl'          => 'sometimes|date',
        ]);

        $data = $request->only(['nama_lap', 'nama_jenis', 'harga', 'kegiatan', 'det_lapangan', 'tgl']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFileBaru = uniqid() . $file->getClientOriginalName();
            $path = $file->move(base_path() . "/public/gambar", $namaFileBaru);
            $data['gambar'] = $namaFileBaru;
            $data['path'] = $path;
        }

        $field->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Lapangan berhasil diperbarui',
            'data'    => $field->fresh(),
        ]);
    }

    /**
     * Delete a field (Admin only).
     *
     * DELETE /api/fields/{id}
     */
    public function destroy($id)
    {
        $field = NamaLapangan::find($id);

        if (!$field) {
            return response()->json([
                'success' => false,
                'message' => 'Lapangan tidak ditemukan',
            ], 404);
        }

        $field->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lapangan berhasil dihapus',
        ]);
    }

    /**
     * Get images for a field.
     *
     * GET /api/fields/{id}/images
     */
    public function images($id)
    {
        $field = NamaLapangan::find($id);

        if (!$field) {
            return response()->json([
                'success' => false,
                'message' => 'Lapangan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $field->images,
        ]);
    }

    /**
     * Upload image for a field (Admin only).
     *
     * POST /api/fields/{id}/images
     */
    public function storeImage(Request $request, $id)
    {
        $field = NamaLapangan::find($id);

        if (!$field) {
            return response()->json([
                'success' => false,
                'message' => 'Lapangan tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'file'   => 'required|image',
        ]);

        $file = $request->file('file');
        $foto = md5($file->getClientOriginalName());
        $path = $file->move(base_path() . "/public/image", $foto);

        $image = ImageLapangan::create([
            'lapangan_id' => $id,
            'filename'    => $foto,
            'path'        => $path,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diupload',
            'data'    => $image,
        ], 201);
    }

    /**
     * Delete a field image (Admin only).
     *
     * DELETE /api/fields/{id}/images/{imageId}
     */
    public function destroyImage($id, $imageId)
    {
        $image = ImageLapangan::where('lapangan_id', $id)
            ->where('id_image', $imageId)
            ->first();

        if (!$image) {
            return response()->json([
                'success' => false,
                'message' => 'Gambar tidak ditemukan',
            ], 404);
        }

        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus',
        ]);
    }
}
