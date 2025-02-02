<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganDomisili extends Model
{
    use HasFactory;

    protected $table = 'keterangan_domisili';

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'rt',
        'rw',
        'ktp_file',
        'kk_file',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusIndonesiaAttribute()
    {
        $status = [
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak'
        ];
        
        return $status[$this->status] ?? $this->status;
    }
}