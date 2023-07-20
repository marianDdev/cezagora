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
        Schema::table('companies', function (Blueprint $table) {
            $table->text('product_description')->nullable();
            $table->string('website')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('vat_id')->nullable();
            $table->string('mcc')->nullable(); //like 6201 for Cezagora
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
};
