<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sambutan;

class SambutanSeeder extends Seeder
{
    public function run(): void
    {
        Sambutan::create([
            'nama' => 'Nama Kepala Desa',
            'jabatan' => 'Kepala Desa',
            'sambutan' => 'Selamat datang di website resmi Desa kami. Melalui website ini, kami berharap dapat memberikan informasi dan pelayanan yang lebih baik kepada seluruh masyarakat. Website ini merupakan salah satu media komunikasi dan transparansi kami kepada seluruh masyarakat dalam melaksanakan program pembangunan desa.',
            'periode' => '2024-2029',
            'image' => 'default.jpg'
        ]);
    }
} 