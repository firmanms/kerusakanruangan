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
        Schema::create('bangunans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tanahs_id')->constrained()->cascadeOnDelete();
            $table->foreignId('masterbangunans_id')->constrained()->cascadeOnDelete();
            $table->string('nama_bangunan');
            $table->integer('panjang');
            $table->integer('lebar');
            $table->integer('luas_tapak');
            $table->string('kepemilikan');
            $table->integer('nilai_perolehan');
            $table->integer('jumlah_lantai');
            $table->year('tahun_dibangun');
            $table->string('ket');
            $table->date('tgl_sk_pemakai');
            $table->integer('njop');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bangunans');
    }
};
