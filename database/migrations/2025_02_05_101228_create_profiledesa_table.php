<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profiledesa', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('synopsis')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->integer('tahun_berdiri')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('alamat')->nullable();
            $table->text('lokasi')->nullable();
            $table->json('visi')->nullable();
            $table->json('misi')->nullable();
            $table->string('logo_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->json('gallery_texts')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profiledesa');
    }
};
