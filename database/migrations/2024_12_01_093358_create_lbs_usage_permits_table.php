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
        Schema::create('lbs_usage_permits', function (Blueprint $table) {
            $table->id();
            $table->string('code',12)->nullable();
            $table->boolean('is_staff');
            $table->string('name')->nullable();
            $table->string('nim')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->tinyInteger('status');

            $table->foreignId('staff_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('staff_id_mentor')->nullable()->constrained()->nullOnDelete();

            // $table->foreignId('study_program_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('laboratory_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('lab_member_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('lbs_usage_permit_details', function (Blueprint $table) {
            $table->id();
            $table->string('code',12)->nullable();
            $table->integer('qty');
            $table->foreignId('lbs_usage_permit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lab_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('stock_card_id')->nullable()->constrained()->nullOnDelete();
            // $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lbs_usage_permits');
        Schema::dropIfExists('lbs_usage_permit_details');
    }
};
