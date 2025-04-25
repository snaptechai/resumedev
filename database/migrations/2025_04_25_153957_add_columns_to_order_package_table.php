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
        Schema::table('order_package', function (Blueprint $table) {
            $table->unsignedInteger('addon_id')->nullable()->after('oid');
            $table->decimal('quantity', 20, 2)->nullable()->after('addon_id');
            $table->decimal('price', 20, 2)->default(0.00)->after('quantity');
            $table->timestamp('created_at')->nullable()->after('price');
            $table->timestamp('updated_at')->nullable()->after('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_package', function (Blueprint $table) {
            $table->dropColumn('addon_id');
            $table->dropColumn('quantity');
            $table->dropColumn('price');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
};
