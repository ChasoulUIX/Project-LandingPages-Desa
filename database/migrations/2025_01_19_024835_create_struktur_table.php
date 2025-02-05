<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('strukturs', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('password');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('no_wa');
            $table->string('akses')->default('view'); // 'full' or 'view'
            $table->date('periode_mulai');
            $table->date('periode_akhir');
            $table->string('status')->default('aktif'); // 'aktif' or 'non-aktif'
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('strukturs');
    }
};