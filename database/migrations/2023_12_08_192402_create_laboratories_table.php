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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('name');
            $table->text('description');
            $table->text('testing_capabilities')->nullable();
            $table->text('specializations')->nullable();
            $table->text('accreditations')->nullable();
            $table->text('certifications')->nullable();
            $table->text('equipment')->nullable();
            $table->string('operating_hours')->nullable();
            $table->unsignedBigInteger('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};
