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
        //aproved
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('satuan');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('item_types', function (Blueprint $table) {
            $table->id();
            $table->string('item_type', 40);
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('item_code',32);
            $table->integer('quantity');
            $table->string('specification');
            $table->string('description')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('item_type_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        // Schema::create('detail_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('qty')->nullable();

        //     $table->foreignId('unit_id')->nullable()->constrained()->nullOnDelete();
        //     $table->foreignId('item_id')->nullable()->constrained()->nullOnDelete();
        //     $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
        Schema::dropIfExists('item_types');
        Schema::dropIfExists('items');
        Schema::dropIfExists('detail_items');
    }
};
