<?php

namespace Database\Seeders;

use App\Models\EquipmentLoan;
use Illuminate\Database\Seeder;
use App\Models\EquipmentLoanDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EquipmentLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EquipmentLoan::factory(10)->create()->each(function($equipment) {
            EquipmentLoanDetail::factory(mt_rand(1, 10))->create([
                'equipment_loan_id' => $equipment->id
            ]);
        });
    }
}
