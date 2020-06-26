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
            'email' => 'j.palotes@gmail.com',
            'status' => 'Activo',
            'password' => bcrypt('123456'),
        ]);

        //Client data
        $client = new \App\Client();

        $client->date_of_admission = date("Y-m-d");
        $client->authorize_data_processing = 1;
        $client->comment = 'Este es un cliente tipo persona';
        $employee = \App\Employee::first();

        //ClientPeople data
        $clientPeople = new \App\ClientPeople();

        $clientPeople->first_name = "Eladio";
        $clientPeople->last_name = "Salamanca";

        $clientPeople->document_type = "Cedula";
        $clientPeople->document_number = "40224190501";
        $clientPeople->document_expire_date = "2024-05-17";
        $clientPeople->document_expedition_date = "2020-01-23";
        $clientPeople->gender = "Masculino";
        $clientPeople->client_code = "C001";
        $clientPeople->birth_date = "1995-05-22";
        $clientPeople->save();

        $category = new \App\Category();
        $category->name = 'Educación';
        $category->color = 'blue';
        $category->save();

        $clientPeople->categories()->sync($category);
        $clientPeople->save();

        //TODO: client contact data

        $client->authorize_data_processing = 1;
        $client->referredBy()->associate($employee);
        $client->contactEmployee()->associate($employee);
        $client->clientPeople()->associate($clientPeople);
        $client->user()->associate($user);
        $client->save();



        //TODO: create company client type
    }
}
