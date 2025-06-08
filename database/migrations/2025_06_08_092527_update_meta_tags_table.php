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
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->dropColumn('google_tag_script');
            $table->text('javascript_code')->nullable()->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->string('google_tag_script')->nullable()->after('meta_keywords');
            $table->dropColumn('javascript_code');
        });
    }
};
