<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTidakMampu extends Model
{
    use HasFactory;

    protected $table = 'surat_tidak_mampu';
    
    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'penghasilan',
        'jumlah_tanggungan',
        'status_rumah',
        'keperluan',
        'status'
    ];

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