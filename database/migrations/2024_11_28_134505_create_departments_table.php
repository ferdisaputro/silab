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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 8)->nullable();
            $table->string('department', 64);
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->nullable();
            $table->string('study_program', 64);

            $table->foreignId('departments_id')->onDelete('CASCADE');
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->nullable();
            $table->string('course', 64);
            $table->boolean('is_active');
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
        Schema::dropIfExists('study_programs');
        Schema::dropIfExists('courses');
    }
};
