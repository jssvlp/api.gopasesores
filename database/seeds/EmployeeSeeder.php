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

        $user->assignRole('asesor');

        $position = Position::first();

        $employee = new Employee();
        $employee->first_name = "Anibal";
        $employee->last_name = "Guzman";
        $employee->commissioner = 1;
        $employee->type = 'Socio';
        $employee->user()->associate($user);
        $employee->position()->associate($position);

        $employee->save();

        //Referidor
        $employee = new Employee();
        $employee->first_name = "Alejandro";
        $employee->last_name = "Torres";
        $employee->commissioner = 1;
        $employee->type = 'Referidor';
        $employee->position()->associate(5);

        $employee->save();



        $user = User::create([
            'email' => 'pruebas@test.com',
            'status' => 'Activo',
            'username' =>'Pruebas',
            'full_name' => 'Juan De los Palotes',
            'picture' => 'https://n8d.at/wp-content/plugins/aioseop-pro-2.4.11.1/images/default-user-image.png',
            'password' => bcrypt('123456'),
        ]);

        $user->assignRole('asesor');

        //Empleado de pruebas
        $employee = new Employee();
        $employee->first_name = "Juan ";
        $employee->last_name = "de los Palotes";
        $employee->commissioner = 1;
        $employee->type = 'Socio';
        $employee->user()->associate($user->id);
        $employee->position()->associate($position);

        $employee->save();

    }
}
