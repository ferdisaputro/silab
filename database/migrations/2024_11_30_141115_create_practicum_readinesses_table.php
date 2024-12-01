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
        Schema::create('practicum_readinesses', function (Blueprint $table) {
            $table->id();
            $table->integer('recomendation')->comment("1 => Siapkan dan Lanjutkan, 2 => Dimodifikasi, 3 => Diganti Acara Praktek yang Lain, 4 => Ditunda");
            $table->date('date');
            $table->foreignId('course_instructors_id')->constrained()->cascadeOnDelete();
            $table->foreignId('semester_courses_id')->constrained()->cascadeOnDelete();
            $table->foreignId('staff_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lab_members_id')->constrained()->cascadeOnDelete();
            $table->foreignId('laboratories_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_weeks_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('practicum_readiness_details', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->integer('qty');
            $table->string('description');
            $table->foreignId('practicum_readinesses_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lab_items_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stock_cards_id')->constrained()->cascadeOnDelete();
            $table->foreignId('units_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practicum_readinesses');
        Schema::dropIfExists('practicum_readiness_details');
    }
};
