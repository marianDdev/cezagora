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
        Schema::create('ingredient_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id');
            $table->string('unit');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('size');
            $table->unsignedBigInteger('price');
            $table->string('availability');
            $table->timestamp('available_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_variants');
    }
};
