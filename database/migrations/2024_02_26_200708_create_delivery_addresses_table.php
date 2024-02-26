<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('country_code');
            $table->string('zipcode');
            $table->string('city');
            $table->unsignedBigInteger('cityId'); //not foreign key, is an id requested by eurosender
            $table->string('street');
            $table->text('additionalInfo')->nullable();
            $table->string('region');
            $table->string('regionCode')->nullable();
            $table->unsignedBigInteger('regionId'); //not foreign key, is an id requested by eurosender
            $table->string('timezone');
            $table->json('customFields')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_addresses');
    }
};
