<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profil';
    protected $primaryKey = 'id_profil';
    public $timestamps = false;

    protected $fillable = [
        'nama_profil',
        'jenis_apk',
        'lokasi',
        'no_profil',
    ];
}
