<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    public function User()
    {
        return $this->hasMany('App\User');
    }

    protected $fillable = ['user_id', 'debit', 'credit', 'saldo'];
}
