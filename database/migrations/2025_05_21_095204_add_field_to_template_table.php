<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('identifier')->nullable()->after('is_active'); 
            $table->integer('package')->nullable()->change();
        });
 
        DB::table('template')->whereNull('identifier')->orWhere('identifier', '')->update([
            'identifier' => DB::raw("CONCAT('template_', id)")
        ]);
 
        Schema::table('template', function (Blueprint $table) {
            $table->unique('identifier', 'template_identifier_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('template', function (Blueprint $table) {
            $table->dropUnique('template_identifier_unique');
            $table->dropColumn('is_active');
            $table->dropColumn('identifier');
            $table->integer('package')->nullable(false)->change();
        });
    }
};