<?php

use App\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position = Position::create([
            'name' => 'Asesor',
            'description' =>'Asesor de seguros'
        ]);
    }
}
