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
        //todo check https://www.capsandjars.com/eng_m_Cosmetic-packaging-449.html to check posible values
        Schema::create('packing_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('packing_product_category_id');
            $table->string('name');
            $table->text('description');
            $table->string('slug');
            $table->integer('price');
            $table->integer('capacity');
            $table->string('colour');
            $table->string('material');
            $table->string('neck_size');
            $table->string('bottom_shape');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_products');
    }
};
