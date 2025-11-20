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
        Schema::create('kredensial_pengguna', function (Blueprint $table) {
            $table->id();
			$table->string('nama_pengguna')->nullable();
            $table->string('nik')->unique();
			$table->string('branch')->nullable();
			$table->string('jabatan')->nullable();
			$table->string('email')->nullable();
			$table->string('hp')->nullable();
			$table->string('keterangan')->nullable();
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kredensial_pengguna');
    }
};
