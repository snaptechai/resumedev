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
        Schema::table('user', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('username');
            $table->string('google_access_token')->nullable()->after('google_id');
            $table->string('google_refresh_token')->nullable()->after('google_access_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'google_access_token', 'google_refresh_token']);
        });
    }
};
