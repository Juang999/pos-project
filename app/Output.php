<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    protected $fillable = ['pj', 'pengeluaran', 'jumlah', 'keterangan'];

    public function User()
    {
        return $this->belongsTo('App\User', 'pj');
    }
}
