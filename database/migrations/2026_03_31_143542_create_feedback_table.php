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
    Schema::create('feedbacks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('full_name');
        $table->string('email');
        $table->string('service');
        $table->integer('rating');
        $table->string('feedback', 100); // 100 character limit
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
