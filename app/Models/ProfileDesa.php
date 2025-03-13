<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDesa extends Model
{
    use HasFactory;

    protected $table = 'profiledesa';

    protected $fillable = [
        'judul',
        'synopsis',
        'email',
        'telephone',
        'tahun_berdiri',
        'deskripsi',
        'alamat',
        'lokasi',
        'visi',
        'misi',
        'logo_image',
        'desa',
        'kecamatan',
        'kabupaten'
    ];

    protected $casts = [
        'visi' => 'array',
        'misi' => 'array'
    ];
}
