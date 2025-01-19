<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kependudukan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'usia',
        'status_keluarga',
        'mata_pencaharian',
        'pendidikan',
        'alamat'
    ];
} 