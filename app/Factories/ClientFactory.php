<?php


namespace App\Factories;


use App\Client;
use App\Company;
use App\ClientPartnership;
use App\People;
use App\Repositories\CompanyClientRepository;
use App\Repositories\ClientPartnershipRepository;
use App\Repositories\PeopleClientRepository;

class ClientFactory
{
    public static function getRepository($type)
    {
        if($type == "people")
        {
            return new PeopleClientRepository(new People());
        }
        elseif ($type == "company")
        {
            return new CompanyClientRepository(new Company());
        }
        return null;


    }
}
