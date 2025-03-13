<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Struktur;
use Illuminate\Support\Facades\Hash;

class StrukturSeeder extends Seeder
{
    public function run()
    {
        $strukturs = [
            [
                'nik' => '1111222233334444',
                'password' => Hash::make('123456'),
                'nama' => 'Default Operator Desa',
                'jabatan' => 'Operator Desa',
                'no_wa' => '0000000000010',
                'akses' => 'full',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'pp.jpg
                '
            ],
        ];

        foreach ($strukturs as $struktur) {
            Struktur::create($struktur);
        }
    }
} 