<?php

use Illuminate\Database\Seeder;
use  \App\Insurance;
class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Insurance::create([
            'name'=>'Amigos Compañía de Seguros, S.A.',
            'rnc' =>'12312423423',
            'phone' =>'(809) 221-5533',
            'email'=>'info@amigosseguros.com',
            'account' => '1231232323',
            'address' =>'Av. Bolívar 755, casi Esq. Máximo Gómez Torre de Especialidades Médicas, 4to Nivel La Esperilla, Santo Domingo, D.N.',

        ]);

        Insurance::create([
            'name'=>'Angloamericana de Seguros, S. A.',
            'rnc' =>'3543543545',
            'phone' =>'(809) 227-2002',
            'email'=>'angloamericana@codetel.net.do',
            'account' => '123323557245',
            'address' =>'Av. Gustavo Mejía Ricart No. 8, Esq. Hnos. Roque Martínez, El Millón, Santo Domingo, R.D.',

        ]);

        Insurance::create([
            'name'=>'Aseguradora Agropecuaria Dominicana, S.A. (AGRODOSA)',
            'rnc' =>'3543548854',
            'phone' =>'(809) 687-4790',
            'email'=>'info@agrodosa.com.do',
            'account' => '31254325',
            'address' =>'Av. Independencia 455, Gascue, Santo Domingo',

        ]);
    }
}
