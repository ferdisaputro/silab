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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('semester');
            $table->boolean('is_even'); // menentukan apakah semester ini genap
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('academic_years_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
