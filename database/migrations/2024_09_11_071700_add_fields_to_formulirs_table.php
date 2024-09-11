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
        Schema::table('formulirs', function (Blueprint $table) {
            $table->double('nilai_akhir')->after('drainaselimbah_tahap2g')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formulirs', function (Blueprint $table) {
            $table->dropColumn([
                'nilai_akhir',
                ]);
        });
    }
};
