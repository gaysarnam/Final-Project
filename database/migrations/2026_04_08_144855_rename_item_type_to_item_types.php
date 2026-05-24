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
        Schema::table('restaurant_menus', function (Blueprint $table) {
            $table->renameColumn('item_type', 'item_types');
        });
    }

    public function down(): void
    {
        Schema::table('restaurant_menus', function (Blueprint $table) {
            $table->renameColumn('item_types', 'item_type');
        });
    }
};