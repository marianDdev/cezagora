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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                  ->nullable()
                  ->default(null);
            $table->string('stripe_customer_id')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('stripe_account_id')->nullable();
            $table->boolean('stripe_account_enabled')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
