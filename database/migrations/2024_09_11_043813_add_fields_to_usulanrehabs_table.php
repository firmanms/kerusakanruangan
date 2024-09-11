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
        Schema::table('usulanrehabs', function (Blueprint $table) {
            $table->date('tgl_pengajuan')->after('id')->nullable();
            $table->string('status')->default('pending')->after('ket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usulanrehabs', function (Blueprint $table) {
            $table->dropColumn([
            'tgl_pengajuan',
            'status',
            ]);
        });
    }
};
