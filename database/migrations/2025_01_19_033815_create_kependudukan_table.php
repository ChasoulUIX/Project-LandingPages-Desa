<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kependudukans', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->integer('usia');
            $table->enum('status_keluarga', ['Kepala Keluarga', 'Istri', 'Anak', 'Lainnya']);
            $table->enum('mata_pencaharian', ['Petani', 'Pedagang', 'PNS', 'Wiraswasta', 'Buruh', 'Lainnya']);
            $table->enum('pendidikan', ['Tidak Sekolah', 'SD', 'SMP', 'SMA/SMK', 'D3', 'S1', 'S2', 'S3']);
            $table->text('alamat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kependudukans');
    }
};