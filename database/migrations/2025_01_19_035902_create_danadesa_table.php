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
            $table->year('tahun_anggaran');
            $table->string('sumber_anggaran');
            $table->decimal('nominal', 15, 2);
            $table->date('tgl_pencairan');
            $table->integer('status_pencairan')->default(0); // Persentase status pencairan
            $table->decimal('dana_masuk', 15, 2)->default(0);
            $table->decimal('dana_terpakai', 15, 2)->default(0);
            $table->json('photos')->nullable(); // Menyimpan array path foto
            $table->timestamps();
            $table->softDeletes(); // Menambahkan soft delete jika diperlukan
        });
    }

    public function down()
    {
        Schema::dropIfExists('danadesa');
    }
};