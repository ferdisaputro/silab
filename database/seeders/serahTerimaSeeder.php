<?php

namespace Database\Seeders;

use App\Models\PracticumResultHandover;
use Database\Factories\PracticeResultHandoverFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class serahTerimaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PracticumResultHandover::factory()->count(30)->create();
    }
}
