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
        Schema::create('wifis', function (Blueprint $table) {
            $table->id();
			$table->string('wifi_name')->nullable();
            $table->string('password')->nullable();
			$table->string('is_active')->nullable();
			$table->string('branch_name')->nullable();
			$table->string('location')->nullable();
			$table->string('ip_portal')->nullable();
			$table->string('user_portal')->nullable();
			$table->string('password_portal')->nullable();
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wifis');
    }
};
