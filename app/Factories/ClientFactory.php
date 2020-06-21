<?php


namespace App\Factories;


use App\Client;
use App\ClientCompany;
use App\ClientPartnership;
use App\Repositories\ClientCompanyRepository;
use App\Repositories\ClientPartnershipRepository;
use App\Repositories\ClientPeopleRepository;

class ClientFactory
{
    public function make($client)
    {


    }

    public static function getRepository($type)
    {
        if($type == "people")
        {
            return new ClientPeopleRepository(new Client());
        }
        elseif ($type == "company")
        {
            return new ClientCompanyRepository(new ClientCompany());
        }
        elseif($type == "partnership")
        {
            return new ClientPartnershipRepository(new ClientPartnership());
        }

        return null;


    }
}
