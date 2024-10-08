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
        Schema::table('users', function (Blueprint $table) {
            $table->string('desa')->after('alamat_sekolah')->nullable();
            $table->string('kecamatan')->after('desa')->nullable();
            $table->string('lat')->after('kecamatan')->nullable();
            $table->string('long')->after('lat')->nullable();
            $table->string('bentuk')->after('nomor_pic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'desa',
                'kecamatan',
                'lat',
                'long',
                'bentuk',
            ]);
        });
    }
};
