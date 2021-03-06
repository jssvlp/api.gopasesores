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
        factory(\App\People::class,20)->create();
        factory(\App\Company::class,20)->create();

        factory(\App\Client::class,40)->create();

        $clients = App\Client::all();
        $counterClient = 1;
        $counterUser = 2;

        $clientCompanyCounter = 1;
        $clientPeopleCounter = 1;
        foreach ($clients as  $client )
        {
            if($counterClient <= 20 )
            {
                $client->people()->associate($clientPeopleCounter);
                $client->save();
                $clientPeopleCounter++;
            }
            else
            {
                $client->company()->associate($clientCompanyCounter);
                $client->save();
                $clientCompanyCounter++;
            }
            $client->user()->associate($counterUser+1);
            $client->owner()->associate(1);

            $client->save();
            $counterUser++;
            $counterClient++;
        }

        //TODO: create company client type
    }
}
