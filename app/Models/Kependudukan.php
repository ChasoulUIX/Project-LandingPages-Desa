<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kependudukan extends Model
{
    use HasFactory;

    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'kependudukan';

    protected $fillable = [
        'nik',
        'no_kk',
        'nama_lengkap',
        'nomor_hp', 
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'golongan_darah',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan_terakhir',
        'status_keluarga'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];
}