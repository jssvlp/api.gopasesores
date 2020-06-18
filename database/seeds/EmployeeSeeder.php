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
            'first_name' => 'Anibal',
            'first_lastname' => 'Guzman',
            'email' => 'a.guzman@gopasesores.com',
            'status' => 'Activo',
            'password' => bcrypt('123456'),
        ]);
        $position = Position::first();

        $employee = new Employee();
        $employee->user()->associate($user);
        $employee->position()->associate($position);

        $employee->save();
    }
}
