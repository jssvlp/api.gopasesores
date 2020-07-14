<?php

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Branch::create([
            'name' =>'Autos Pesados',
            'commission_percentage' => 15,
            'itbis' => 18,
            'insurance_id' => 1,
            'main_branch_id' => 7,

        ]);
    }
}
