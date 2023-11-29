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
        Schema::rename('packing_products', 'packagings');
        Schema::rename('packing_product_categories', 'packaging_categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packing_products', function (Blueprint $table) {
            //
        });
    }
};
