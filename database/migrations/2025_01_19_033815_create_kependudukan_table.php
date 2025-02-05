<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kependudukan', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16);
            $table->string('no_kk', 16);
            $table->string('nama_lengkap');
            $table->string('nomor_hp')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('golongan_darah')->nullable();
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pekerjaan');
            $table->string('pendidikan_terakhir');
            $table->string('status_keluarga');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kependudukan');
    }
};