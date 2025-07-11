<?php

use App\Services\Notification\NotificationServiceInterface;
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
        Schema::table('notifications', function (Blueprint $table) {
            $table->after('receiver_email', function (Blueprint $table) {
                $table->string('country')->nullable();
                $table->string('phone')->nullable();
                $table->string('status')->default(NotificationServiceInterface::STATUS_PENDING);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            //
        });
    }
};
