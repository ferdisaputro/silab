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
            $table->string('code',12);
            $table->boolean('is_staff');
            $table->string('name');
            $table->string('nim');
            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->foreignId('staff_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('staff_id_mentor')->nullable()->constrained()->nullOnDelete();
            
            $table->foreignId('study_programs_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('laboratories_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('lab_members_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('lbs_usage_permit_details', function (Blueprint $table) {
            $table->id();
            $table->string('code',12);
            $table->integer('qty');

            $table->foreignId('lbs_usage_permits_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lab_items_id')->constrained()->cascadeOnDelete();
            $table->foreignId('units_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('stock_cards_id')->nullable()->constrained()->nullOnDelete();
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
