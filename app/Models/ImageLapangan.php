<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLapangan extends Model
{
    use HasFactory;

    protected $table = 'image_lapangan';
    protected $primaryKey = 'id_image';
    public $timestamps = false;

    protected $fillable = [
        'lapangan_id',
        'filename',
        'path',
        'updated_at',
        'created_at',
    ];

    /**
     * Get the field that owns this image.
     */
    public function lapangan()
    {
        return $this->belongsTo(NamaLapangan::class, 'lapangan_id', 'id_lapangan');
    }
}
