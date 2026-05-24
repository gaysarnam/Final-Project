<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the google_id column
            $table->string('google_id')->nullable()->after('id');
            
            // Make password nullable so Google users can register without one
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the google_id if we rollback
            $table->dropColumn('google_id');
            
            // Revert password to NOT NULL (standard behavior)
            $table->string('password')->nullable(false)->change();
        });
    }
};