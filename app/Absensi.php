<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'kasir_id',
        'status',
        'total_kehadiran',
        'total_tidak_hadir',
        'keterangan',
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
