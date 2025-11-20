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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            // --- Employee Identification ---
            $table->string('employee_id')->unique(); // Unique identifier (e.g., NIP/NIK)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Link to the 'users' table if the employee has a login account
            
            // --- Personal Information ---
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('address')->nullable();

            // --- Job Details ---
            $table->string('position'); // Jabatan
            $table->string('department'); // Departemen
            $table->date('hire_date'); // Tanggal mulai bekerja
            $table->enum('employment_status', ['Aktif', 'Cuti', 'Resign', 'Pensiun'])->default('Aktif');
            
            // --- Financial/Other ---
            $table->decimal('salary', 10, 2)->nullable(); // Gaji (optional)

            $table->timestamps(); // created_at and updated_at
            $table->softDeletes(); // Optional: For 'soft deletion' (keeping the record but marking it as deleted)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
