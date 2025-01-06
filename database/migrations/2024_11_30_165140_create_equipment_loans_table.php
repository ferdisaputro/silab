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
        Schema::create('equipment_loans', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->foreignId('staff_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->boolean('is_staff');
            $table->dateTime('borrowing_date');
            $table->string('name');
            $table->string('nim');
            $table->string('group_class')->comment('golongan_kelompok');

            $table->foreignId('staff_id_returner')->nullable()->constrained(table: 'staff', column: 'id')->onDelete('SET NULL');
            $table->boolean('is_returner_staff');
            $table->dateTime('return_date');
            $table->string('returner_name');
            $table->string('returner_nim');
            $table->string('returner_group_class')->comment('kembali_golongan_kelompok');

            $table->tinyInteger('status')->comment('1 => on loan, 2 => returned');

            $table->foreignId('laboratory_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('lab_member_id_borrow')->nullable()->constrained(table: 'lab_members', column: 'id')->onDelete('SET NULL');
            $table->foreignId('lab_member_id_return')->nullable()->constrained(table: 'lab_members', column: 'id')->onDelete('SET NULL');
            $table->foreignId('staff_id_mentor')->nullable()->constrained(table: 'staff', column: 'id')->onDelete('SET NULL');
            $table->timestamps();
        });

        Schema::create('equipment_loan_details', function (Blueprint $table) {
            $table->id();
            $table->string('code',12);
            $table->integer('qty');
            $table->integer('return_qty');
            $table->string('description');
            $table->tinyInteger('status')->comment('1 => on loan, 2 => returned');
            $table->foreignId('equipment_loan_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('lab_item_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('stock_card_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_loans');
        Schema::dropIfExists('equipment_loan_details');
    }
};
