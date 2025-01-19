<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'name',
        'nik', 
        'phone',
        'category',
        'description',
        'attachment',
        'status',
        'response'
    ];
}