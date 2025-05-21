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
        Schema::table('template', function (Blueprint $table) {
            $table->boolean('is_active')->default(1)->after('image');
            $table->string('identifier')->unique()->after('is_active');
            $table->integer('package')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('template', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('identifier');
            $table->integer('package')->nullable(false)->change();
        });
    }
};
