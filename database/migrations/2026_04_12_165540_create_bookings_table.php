<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('service_type'); // Restaurant, Lodging, or Spa
            $table->string('service_name'); // e.g., T-01, Suite Room, or Massage
            $table->date('booking_date');
            $table->time('booking_time')->nullable(); // Nullable for lodging
            $table->date('check_out_date')->nullable(); // Only for lodging
            $table->text('special_request')->nullable();
            $table->string('status')->default('Pending');
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
