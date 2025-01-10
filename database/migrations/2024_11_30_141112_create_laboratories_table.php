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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->nullable();
            $table->string('name');
            // $table->boolean('is_active');
            $table->string('acronym')->nullable();
            $table->string('color', 15)->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('lab_members', function (Blueprint $table) {
            $table->id();
            // $table->string('code', 12);
            $table->boolean('is_lab_leader');
            $table->boolean('is_active')->default(1);
            $table->foreignId('laboratory_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('lab_items', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->nullable();
            $table->string('description')->nullable();
            $table->integer('stock');
            $table->foreignId('laboratory_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('item_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('is_active');
            $table->timestamps();
        });

        // Schema::create('lab_item_details', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('code', 12);
        //     $table->integer('qty');
        //     $table->string('description');
        //     $table->foreignId('practicum_readinesse_id')->nullable()->constrained()->cascadeOnDelete();
        //     $table->foreignId('lab_item_id')->nullable()->constrained()->cascadeOnDelete();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
        Schema::dropIfExists('lab_members');
        Schema::dropIfExists('lab_items');
        // Schema::dropIfExists('lab_item_details');
    }
};
