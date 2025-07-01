<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_menus', function (Blueprint $table) {
            // Foreign key untuk role
            $table->foreignId('role_id')->constrained()->onDelete('cascade');

            // Foreign key untuk menu
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');

            // Set primary key
            $table->primary(['role_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_menus');
    }
};
