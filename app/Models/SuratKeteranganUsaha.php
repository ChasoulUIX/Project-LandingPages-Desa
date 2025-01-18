<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganUsaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_usaha',
        'jenis_usaha',
        'alamat_usaha',
        'tahun_mulai',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tahun_mulai' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
