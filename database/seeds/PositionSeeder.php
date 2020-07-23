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

        $position = Position::create([
            'name' => 'Socio',
            'description' =>'Socio'
        ]);

        $position = Position::create([
            'name' => 'Secretaria',
            'description' =>'Secretaria'
        ]);

        $position = Position::create([
            'name' => 'Vendedor',
            'description' =>'Vendedor'
        ]);

        $position = Position::create([
            'name' => 'Referidor externo',
            'description' =>'Referidor externo'
        ]);
    }
}
