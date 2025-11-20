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
        Schema::table('commodity_locations', function (Blueprint $table) {
            $table->string('nama_pt')->nullable()->after('name');
            $table->string('alamat')->nullable()->after('nama_pt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commodity_locations', function (Blueprint $table) {
            $table->dropColumn('nama_pt');
            $table->dropColumn('alamat');
        });
    }
};
