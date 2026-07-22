<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSewa extends Model
{
    use HasFactory;

    protected $table = 'data_sewa';
    protected $primaryKey = 'id_sewa';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'lap_id',
        'tanggal',
        'tempo',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
        'konfirmasi',
        'bukti_tf',
        'dokumen',
    ];

    /**
     * Get the user that owns this rental.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * Get the field for this rental.
     */
    public function lapangan()
    {
        return $this->belongsTo(NamaLapangan::class, 'lap_id', 'id_lapangan');
    }
}
