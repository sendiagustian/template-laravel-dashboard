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
        Schema::create('user_roles', function (Blueprint $table) {
            // Foreign key untuk user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Foreign key untuk role
            $table->foreignId('role_id')->constrained()->onDelete('cascade');

            // Set primary key sebagai kombinasi keduanya untuk mencegah duplikat
            $table->primary(['user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
