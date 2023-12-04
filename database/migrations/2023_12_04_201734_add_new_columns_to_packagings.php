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
        Schema::table('packagings', function (Blueprint $table) {
            $table->after('bottom_shape', function (Blueprint $table) {
                $table->unsignedBigInteger('quantity');
                $table->string('availability');
                $table->timestamp('available_at')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packagings', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('availability');
            $table->dropColumn('available_at');
        });
    }
};
