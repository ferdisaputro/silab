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
        Schema::create('semester_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_programs_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('semesters_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('courses_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('total_group'); // total_golongan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_courses');
    }
};
