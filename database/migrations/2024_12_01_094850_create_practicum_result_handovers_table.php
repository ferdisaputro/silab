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
        Schema::create('practicum_result_leftover_handovers', function (Blueprint $table) {
            $table->id();
            $table->string('code',12);
            $table->string('practicum_event');
            $table->date('date');

            $table->foreignId('course_instructors_id')->constrained()->cascadeOnDelete()->name('fk_course_instructors');
            $table->foreignId('academic_weeks_id')->constrained()->cascadeOnDelete()->name('fk_academic_weeks');
            $table->foreignId('laboratories_id')->constrained()->cascadeOnDelete()->name('fk_laboratories');
            $table->foreignId('lab_members_id')->constrained()->cascadeOnDelete()->name('fk_lab_members');
            $table->timestamps();
        });

        Schema::create('practicum_result', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->integer('qty');
            $table->string('description');

            $table->foreignId('practicum_result_leftover_handovers_id')->constrained()->cascadeOnDelete()->name('fk_practicum_result_leftover_handovers');
            $table->foreignId('lab_items_id')->nullable()->constrained()->nullOnDelete()->name('fk_lab_items');
            $table->foreignId('stock_cards_id')->nullable()->constrained()->nullOnDelete()->name('fk_stock_cards');
            $table->timestamps();
        });

        Schema::create('practicum_leftover', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->unsignedInteger('qty');

            $table->foreignId('lab_items_id')->constrained()->cascadeOnDelete()->name('fk_lab_items');
            $table->foreignId('stock_cards_id')->nullable()->constrained()->nullOnDelete()->name('fk_stock_cards');
            $table->foreignId('practicum_result_leftover_handovers_id')->constrained()->cascadeOnDelete()->name('fk_practicum_result_leftover_handovers');
            $table->foreignId('units_id')->constrained()->cascadeOnDelete()->name('fk_units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practice_result_handovers');
    }
};
