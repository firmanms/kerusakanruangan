<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('npsn')->after('email')->nullable();
            $table->string('alamat_sekolah')->after('npsn')->nullable();
            $table->string('nama_pic')->after('alamat_sekolah')->nullable();
            $table->string('nomor_pic')->after('nama_pic')->nullable();
            $table->string('jenjang')->after('nomor_pic')->nullable();
            $table->string('status')->after('jenjang')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'npsn',
                'alamat_sekolah',
                'nama_pic',
                'nomor_pic',
                'jenjang',
                'status',
            ]);
        });
    }
}

