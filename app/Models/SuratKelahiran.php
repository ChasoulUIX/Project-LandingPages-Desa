<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKelahiran extends Model
{
    use HasFactory;

    protected $table = 'surat_kelahiran';
    
    protected $fillable = [
        'user_id',
        'nama_anak',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_ayah',
        'nik_ayah',
        'nama_ibu',
        'nik_ibu',
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
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak'
        ];
        
        return $status[$this->status] ?? $this->status;
    }
} 