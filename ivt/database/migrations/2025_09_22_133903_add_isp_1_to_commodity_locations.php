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
            $table->string('vendor_isp_1')->nullable()->after('no_inet');
            $table->string('no_inet_1')->nullable()->after('vendor_isp_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commodity_locations', function (Blueprint $table) {
            $table->dropColumn('vendor_isp_1');
            $table->dropColumn('no_inet_1');
        });
    }
};
