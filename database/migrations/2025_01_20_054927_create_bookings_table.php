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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('bidding_id')->nullable()->constrained('biddings')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('partner_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('status')->default('PENDING');
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
