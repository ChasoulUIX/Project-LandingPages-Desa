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
                'nik' => '0000000000000001',
                'password' => Hash::make('password'),
                'nama' => 'Default Kepala Desa',
                'jabatan' => 'Kepala Desa',
                'no_wa' => '0000000000001',
                'akses' => 'full',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
            [
                'nik' => '0000000000000002',
                'password' => Hash::make('password'),
                'nama' => 'Default Sekretaris Desa',
                'jabatan' => 'Sekretaris Desa',
                'no_wa' => '0000000000002',
                'akses' => 'view',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
            [
                'nik' => '0000000000000003',
                'password' => Hash::make('password'),
                'nama' => 'Default Bendahara Desa',
                'jabatan' => 'Bendahara Desa',
                'no_wa' => '0000000000003',
                'akses' => 'view',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
            [
                'nik' => '0000000000000004',
                'password' => Hash::make('password'),
                'nama' => 'Default Kaur Umum',
                'jabatan' => 'Kaur Umum',
                'no_wa' => '0000000000004',
                'akses' => 'view',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
            [
                'nik' => '0000000000000005',
                'password' => Hash::make('password'),
                'nama' => 'Default Kaur Keuangan',
                'jabatan' => 'Kaur Keuangan',
                'no_wa' => '0000000000005',
                'akses' => 'view',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
            [
                'nik' => '0000000000000006',
                'password' => Hash::make('password'),
                'nama' => 'Default Kasi Pemerintahan',
                'jabatan' => 'Kasi Pemerintahan',
                'no_wa' => '0000000000006',
                'akses' => 'view',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
            [
                'nik' => '0000000000000007',
                'password' => Hash::make('password'),
                'nama' => 'Default Kasi Kesejahteraan',
                'jabatan' => 'Kasi Kesejahteraan',
                'no_wa' => '0000000000007',
                'akses' => 'view',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
            [
                'nik' => '0000000000000008',
                'password' => Hash::make('password'),
                'nama' => 'Default Kasi Pelayanan',
                'jabatan' => 'Kasi Pelayanan',
                'no_wa' => '0000000000008',
                'akses' => 'view',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
            [
                'nik' => '0000000000000009',
                'password' => Hash::make('password'),
                'nama' => 'Default Kasi Pembangunan',
                'jabatan' => 'Kasi Pembangunan',
                'no_wa' => '0000000000009',
                'akses' => 'view',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
            [
                'nik' => '0000000000000010',
                'password' => Hash::make('password'),
                'nama' => 'Default Operator Desa',
                'jabatan' => 'Operator Desa',
                'no_wa' => '0000000000010',
                'akses' => 'view',
                'periode_mulai' => '2024-01-01',
                'periode_akhir' => '2029-12-31',
                'status' => 'aktif',
                'image' => 'default.jpg'
            ],
        ];

        foreach ($strukturs as $struktur) {
            Struktur::create($struktur);
        }
    }
} 