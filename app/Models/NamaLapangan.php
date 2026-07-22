<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaLapangan extends Model
{
    use HasFactory;

    protected $table = 'nama_lapangan';
    protected $primaryKey = 'id_lapangan';
    public $timestamps = false;

    protected $fillable = [
        'nama_lap',
        'nama_jenis',
        'harga',
        'gambar',
        'kegiatan',
        'det_lapangan',
        'tgl',
        'path',
    ];

    /**
     * Get the images for this field.
     */
    public function images()
    {
        return $this->hasMany(ImageLapangan::class, 'lapangan_id', 'id_lapangan');
    }

    /**
     * Get the rentals for this field.
     */
    public function dataSewa()
    {
        return $this->hasMany(DataSewa::class, 'lap_id', 'id_lapangan');
    }
}
