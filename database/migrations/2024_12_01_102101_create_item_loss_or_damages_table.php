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
        Schema::create('item_loss_or_damages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->string('name');
            $table->string('nim');
            $table->string('group_class');
            $table->tinyInteger('status')->comment("1 => waiting, 2 => approved, 3 => rejected");
            $table->dateTime('date_replace_agreement');

            $table->foreignId('laboratory_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lab_member_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('item_loss_or_damage_details', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12);
            $table->integer('amount_loss_damaged');
            $table->tinyInteger('status')->comment('1 => waiting, 2 => approved, 3 => rejected');

            $table->foreignId('item_loss_or_damage_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lab_item_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_loss_or_damages');
        Schema::dropIfExists('item_loss_or_damage_details');
    }
};
