<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tanahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama_tanah');
            $table->string('no_sertifikat');
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('luas');
            $table->integer('luas_tersedia');
            $table->string('kepemilikan');
            $table->string('ket');
            $table->string('alamat');
            $table->integer('rt');
            $table->integer('rw');
            $table->string('dusun');
            $table->integer('masterkecamatans_id');
            $table->integer('masterdesas_id');
            $table->integer('kode_pos');
            $table->string('lat');
            $table->string('long');
            $table->integer('njop');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanahs');
    }
};
