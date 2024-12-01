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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('start_year', 5)->nullable();
            $table->string('end_year', 5)->nullable();
            $table->boolean('is_even');
            $table->boolean('is_active');
            $table->timestamps();
        });

        Schema::create('academic_weeks', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('description');
            $table->foreignId('academic_years_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('semester');
            $table->boolean('is_even'); // menentukan apakah semester ini genap
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('academic_years_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('semester_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_programs_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('semesters_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('courses_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('total_group'); // total_golongan
            $table->timestamps();
        });

        Schema::create('course_instructors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_courses_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_years');
        Schema::dropIfExists('academic_weeks');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('semester_courses');
        Schema::dropIfExists('course_instructors');
    }
};
