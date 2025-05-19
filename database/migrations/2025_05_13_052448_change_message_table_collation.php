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
        Schema::table('message', function (Blueprint $table) {
            // $table->string('message')->collation('utf8mb4_unicode_ci')->change();
            // $table->string('type')->collation('utf8mb4_unicode_ci')->change();
            // $table->string('adate')->collation('utf8mb4_unicode_ci')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('message', function (Blueprint $table) {
            // $table->string('message')->collation('utf8mb3_general_ci')->change();
            // $table->string('type')->collation('utf8mb3_general_ci')->change();
            // $table->string('adate')->collation('utf8mb3_general_ci')->change();
        });
    }
};