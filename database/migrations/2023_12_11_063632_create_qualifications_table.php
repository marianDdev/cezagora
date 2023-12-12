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
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('type');
            $table->string('name');
            $table->string('issuer');
            $table->string('certificate_number');
            $table->string('scope');
            $table->string('url')->nullable();
            $table->string('verification_link');
            $table->text('additional_info')->nullable();
            $table->timestamp('issued_at');
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qualifications');
    }
};
