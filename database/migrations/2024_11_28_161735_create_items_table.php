<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // aproved
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('specification');
            $table->string('description');
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('units_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('item_types_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
