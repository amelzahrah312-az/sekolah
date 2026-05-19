<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Hapus enum lama, ganti dengan varchar
            $table->string('jurusan', 50)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->enum('jurusan', ['IPA', 'IPS', 'Bahasa'])->nullable()->change();
        });
    }
};