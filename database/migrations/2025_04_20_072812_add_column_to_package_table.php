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
        Schema::table('package', function (Blueprint $table) {
            $table->text('addons')->nullable()->after('short_description');
            $table->decimal('discount',8,2)->nullable()->after('price');
            $table->integer('is_popular')->default(0)->after('discount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package', function (Blueprint $table) {
            $table->dropColumn('addons');
            $table->dropColumn('discount');
            $table->dropColumn('is_popular');
        });
    }
};
