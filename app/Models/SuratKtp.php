<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKtp extends Model
{
    use HasFactory;

    protected $table = 'surat_ktp';
    
    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'rt',
        'rw',
        'keperluan',
        'status',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusIndonesiaAttribute()
    {
        $status = [
            'pending' => 'Menunggu',
            'processed' => 'Diproses',
            'completed' => 'Selesai',
            'rejected' => 'Ditolak'
        ];
        
        return $status[$this->status] ?? $this->status;
    }
} 