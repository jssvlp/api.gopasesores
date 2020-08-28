<?php

use Illuminate\Database\Seeder;

class CoveragesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Coverturas para rama de vehiculos de motor
        $coverages = ['Daños a la propiedad Ajena','Lesiones Corporales o Muerte a una persona','Lesiones Corporales o Muerte a mas de una personas','Lesiones Corporales o Muerte a un Pasajero','Lesiones Corporales o Muerte a mas de un pasajero','Riesgo del conductor','Fianza','Colision y Vuelco','Rotura de Cristales','Incendio & Robo','Gastos Exequiales','Aeroambulancia','Centro del Automovilista','Casa del Conductor','Asistencia Vial','Seguridad Vial','Seguro de Vida','Accidentes Personales','Riesgos Comprensivos','Todo Riesgo','Alquiler de Vehiculo','Ayuda Mecanica'];

        foreach ($coverages as $coverage)
        {
            \App\Coverage::create(['name' =>$coverage,'branch_id' => 5]);
        }
    }
}
