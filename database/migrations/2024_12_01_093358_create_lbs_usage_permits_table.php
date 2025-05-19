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

            $table->foreignId('staff_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('staff_id_returner')->nullable()->constrained(table: 'staff', column: 'id')->onDelete('SET NULL');
            $table->boolean('is_staff')->nullable();
            $table->boolean('is_returner_staff')->nullable();

            $table->string('name')->nullable();
            $table->string('returner_name')->nullable();
            $table->string('nim')->nullable();
            $table->string('returner_nim')->nullable();
            $table->string('group_class')->nullable()->comment('golongan_kelompok');
            $table->string('returner_group_class')->nullable()->comment('kembali_golongan_kelompok');

            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('status')->comment('1 => on loan, 2 => returned');

            // $table->foreignId('staff_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('staff_id_mentor')->nullable()->constrained(table: 'staff', column: 'id')->onDelete('SET NULL');
            // $table->foreignId('study_program_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('laboratory_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('lab_member_id_borrow')->nullable()->constrained(table: 'lab_members', column: 'id')->onDelete('SET NULL');
            $table->foreignId('lab_member_id_return')->nullable()->constrained(table: 'lab_members', column: 'id')->onDelete('SET NULL');
            $table->timestamps();
        });

        Schema::create('lbs_usage_permit_details', function (Blueprint $table) {
            $table->id();
            // $table->string('code',12)->nullable();
            $table->integer('qty');
            $table->integer('return_qty')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->nullable()->comment('1 => complete, 2 => incomplete');
            $table->foreignId('lbs_usage_permit_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('lab_item_id')->constrained()->onDelete('CASCADE');
            // $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('stock_card_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('stock_card_id_return')->nullable()->constrained(table: 'stock_cards', column: 'id')->onDelete('SET NULL');
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
