<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('danadesa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->string('kategori');
            $table->decimal('anggaran', 15, 2);
            $table->integer('progress');
            $table->string('status');
            $table->string('target');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('danadesa');
    }
};