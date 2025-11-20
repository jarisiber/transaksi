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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unique('no_tiket')->nullable();
			$table->string('email')->nullable();
			$table->string('departemen')->nullable();
			$table->string('priority')->nullable();
			$table->string('judul')->nullable();
			$table->string('tinyInteger')->nullable()->default('1');
			$table->string('ditutup_oleh')->nullable();
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
