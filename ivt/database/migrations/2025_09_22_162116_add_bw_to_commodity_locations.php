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
            $table->string('bw')->nullable()->after('no_inet');
            $table->string('bw_1')->nullable()->after('no_inet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commodity_locations', function (Blueprint $table) {
            $table->dropColumn('bw');
            $table->dropColumn('bw_1');
        });
    }
};
