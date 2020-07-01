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
        $nowCompany = false;
        foreach ($clients as  $client )
        {
            if($counterClient <= 20 && $nowCompany == false)
            {
                $client->people()->associate($counterClient);
            }
            else
            {
                $nowCompany = true;
                $counterClient = 1;
                $client->company()->associate($counterClient);
            }
            $client->user()->associate($counterUser+1);
            $client->referredBy()->associate(1);
            $client->contactEmployee()->associate(1);
            $client->contact()->associate(1);

            $client->save();
            $counterUser++;
            $counterClient++;
        }

        //TODO: create company client type
    }
}
