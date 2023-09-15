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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->text('name');
            $table->string('common_name')->nullable();
            $table->text('description');
            $table->string('function');
            $table->unsignedInteger('price');
            $table->integer('quantity');
            $table->string('availability');
            $table->timestamp('available_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
