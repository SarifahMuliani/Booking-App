<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUser extends Model
{
    use HasFactory;

    protected $table = 'datauser';
    protected $primaryKey = 'id_datauser';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'email',
        'no_telp',
        'jenis_kelamin',
        'ktp',
        'alamat_penyewa',
    ];

    /**
     * Get the user that owns this data.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
