<?php

use Illuminate\Database\Seeder;

class EconomicActSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\EconomicActivity::create(['name' =>'Finanzas']);
    }
}
