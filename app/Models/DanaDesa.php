<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanaDesa extends Model
{
    protected $table = 'danadesa';

    protected $fillable = [
        'nama_program',
        'kategori',
        'anggaran',
        'progress',
        'status',
        'target'
    ];

    public function getKategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}