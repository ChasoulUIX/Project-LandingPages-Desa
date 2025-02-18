<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Struktur extends Authenticatable
{
    protected $guard = 'struktur';

    protected $fillable = [
        'nik',
        'password',
        'nama',
        'jabatan',
        'no_wa',
        'akses',
        'periode_mulai',
        'periode_akhir',
        'status',
        'image'
    ];

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'nik';
    }
}