<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,HasRoles;

    protected $guard_name = 'WebApi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'nomor_telepon',
        'kode_member',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function Tabungan()
    {
        return $this->hasMany('App\Tabungan');
    }

    public function Transaksi()
    {
        return $this->hasMany('App\Transaksi');
    }

    public function Pembelian()
    {
        return $this->hasMany('App\Pembelian');
    }

    public function Penjualan()
    {
        return $this->hasMany('App\Penjualan');
    }

    public function Absensi()
    {
        return $this->hasMany('App\Absensi');
    }

    public function Output()
    {
        return $this->hasMany('App\Output');
    }

}
