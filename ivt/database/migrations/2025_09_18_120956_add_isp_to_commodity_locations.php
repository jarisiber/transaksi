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
            $table->string('vendor_isp')->nullable()->after('nama_pt');
            $table->string('no_inet')->nullable()->after('vendor_isp');
            $table->string('email_digunakan')->nullable()->after('no_inet');
            $table->string('is_active')->nullable()->after('no_inet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commodity_locations', function (Blueprint $table) {
            $table->dropColumn('vendor_isp');
            $table->dropColumn('no_inet');
            $table->dropColumn('email_digunakan');
            $table->dropColumn('is_active');
        });
    }
};
