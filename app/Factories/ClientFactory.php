<?php


namespace App\Factories;


use App\Client;
use App\ClientCompany;
use App\ClientPartnership;
use App\ClientPeople;
use App\Repositories\ClientCompanyRepository;
use App\Repositories\ClientPartnershipRepository;
use App\Repositories\ClientPeopleRepository;

class ClientFactory
{
    public static function getRepository($type)
    {
        if($type == "people")
        {
            return new ClientPeopleRepository(new ClientPeople());
        }
        elseif ($type == "company")
        {
            return new ClientCompanyRepository(new ClientCompany());
        }
        return null;


    }
}
