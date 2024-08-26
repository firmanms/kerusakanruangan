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
        Schema::create('ruangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bangunans_id')->constrained()->cascadeOnDelete();
            $table->foreignId('masterruangs_id')->constrained()->cascadeOnDelete();
            $table->foreignId('masterjenisprasaranas_id')->constrained()->cascadeOnDelete();
            $table->string('kode_ruang');
            $table->string('nama_ruang');
            $table->string('registrasi_ruang');
            $table->integer('lantai_ke');
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('luas');
            $table->integer('kapasitas');
            $table->integer('lplester');
            $table->integer('lplafon');
            $table->integer('ldinding');
            $table->integer('ldaunjendela');
            $table->integer('ldaunpintu');
            $table->integer('lkusen');
            $table->integer('ltutuplantai');
            $table->integer('linstalasilistrik');
            $table->integer('jmlinstalasilistrik');
            $table->integer('pdrainase');
            $table->integer('lfinishstruktur');
            $table->integer('lfinishplafon');
            $table->integer('lfinishdinding');
            $table->integer('lfinishkpj');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangs');
    }
};
