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
        Schema::create('proposed_needs', function (Blueprint $table) {
            $table->id();
            $table->string('practicum_event');
            // $table->tinyInteger('needs');
            $table->tinyInteger('total_group')->comment('jumlah_kel');
            $table->tinyInteger('total_class')->comment('jumlah_gol');
            $table->string('description', 255);
            $table->tinyInteger('status')->comment('1 => submit, 2 => review, 3 => print, 4 => accepted'); //1 => pengajuan, 2 =>review, 3 => cetak, 4 => acc

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('academic_week_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('course_instructor_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('laboratory_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('proposed_need_details', function (Blueprint $table) {
            $table->id();
            // $table->integer('group_needs');
            $table->integer('total_needs');
            $table->integer('accepted_needs');
            $table->string('description');
            $table->tinyInteger('status')->comment('1 => pending, 2 => accepted, 3 => rejected');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('stock_cards', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->integer('qty');
            $table->integer('stock');
            $table->boolean('is_stock_in');
            $table->string('description');
            $table->string('system_description');
            $table->foreignId('lab_item_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('lab_member_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('proposed_need_detail_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposed_needs');
        Schema::dropIfExists('proposed_need_details');
    }
};
