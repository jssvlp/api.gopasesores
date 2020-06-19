<?php

use App\Client;
use App\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Juan',
            'first_lastname' => 'De los palotes',
            'email' => 'j.palotes@gmail.com',
            'status' => 'Activo',
            'password' => bcrypt('123456'),
        ]);

        $referred = \App\Employee::first();

        $client = new Client();
        $client->user()->associate($user);
        $client->date_of_admission = date('Y-m-d');
        $client->status = 'Activo';

        $client->referredBy()->associate($referred);
        $client->contactEmployee()->associate($referred);

        $client->save();
    }
}
