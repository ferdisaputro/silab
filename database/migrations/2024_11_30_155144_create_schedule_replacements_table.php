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
        Schema::create('schedule_replacements', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->string('practicum_event');
            $table->dateTime('real_schedule');
            $table->dateTime('replacement_schedule');
            $table->foreignId('head_of_study_programs_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('lab_members_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('courses_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('staff_id')->constrained()->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_replacements');
    }
};
