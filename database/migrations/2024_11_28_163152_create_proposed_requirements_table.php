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
        Schema::create('proposed_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('acara_praktek', 64);
            $table->unsignedTinyInteger('keb_kel');
            $table->unsignedTinyInteger('jml_kel');
            $table->string('keterangan', 255);
            $table->unsignedTinyInteger('status')->comment('1 => pengajuan, 2 =>review tim bahan, 3 => cetak tim bahan, 4 => acc ');

            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('units_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('academic_weeks_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('items_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('course_instructors_id')->nullable()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposed_requirements');
    }
};
