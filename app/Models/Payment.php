<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    protected $primaryKey = 'id_payment';
    public $timestamps = false;

    protected $fillable = [
        'no_rek',
        'nama_rek',
    ];
}
