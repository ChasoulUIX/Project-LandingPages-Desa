<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aktifitas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('image');
            $table->date('tgl_mulai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aktifitas');
    }
};
