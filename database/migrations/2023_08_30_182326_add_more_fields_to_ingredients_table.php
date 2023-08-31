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
        Schema::table('ingredients', function (Blueprint $table) {
            $table->foreignId('company_id')->after('id');
            $table->after('slug', function (Blueprint $table) {
                $table->unsignedInteger('price');
                $table->integer('quantity');
                $table->string('availability');
                $table->timestamp('available_at');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->dropColumn('quantity');
            $table->dropColumn('availability');
            $table->dropColumn('available_at');
        });
    }
};
