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
        Schema::create('masterdesas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masterkecamatans_id')->constrained()->cascadeOnDelete();
            $table->string('nama');
            $table->integer('kode_pos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterdesas');
    }
};
