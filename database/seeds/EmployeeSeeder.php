<?php

use App\Employee;
use App\Position;
use App\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'a.guzman@gopasesores.com',
            'status' => 'Activo',
            'picture' => 'https://n8d.at/wp-content/plugins/aioseop-pro-2.4.11.1/images/default-user-image.png',
            'password' => bcrypt('123456'),
        ]);


        $position = Position::first();

        $employee = new Employee();
        $employee->first_name = "Anibal";
        $employee->last_name = "Guzman";
        $employee->commissioner = 1;
        $employee->type = 'Socio';
        $employee->user()->associate($user);
        $employee->position()->associate($position);

        $employee->save();

        //Referidor externo
        $employee = new Employee();
        $employee->first_name = "Juan Alejandro";
        $employee->last_name = "Perez";
        $employee->commissioner = 1;
        $employee->type = 'Referidor';
        $employee->user()->associate($user);
        $employee->position()->associate(5);

        $employee->save();
    }
}
