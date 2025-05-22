<?php

use App\Models\Laboratory;
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
            $table->string('practicum_event')->nullable();
            $table->dateTime('real_schedule');
            $table->dateTime('replacement_schedule');
            $table->foreignId('head_of_study_program_id')->constrained()->onDelete('CASCADE');
            $table->foreignIdFor(Laboratory::class)->constrained()->cascadeOnDelete();
            $table->foreignId('lab_member_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('course_id')->constrained()->onDelete('CASCADE');
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
