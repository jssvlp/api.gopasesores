<?php


namespace App\Factories;


use App\Client;
use App\Company;
use App\ClientPartnership;
use App\People;
use App\Repositories\ClientCompanyRepository;
use App\Repositories\ClientPartnershipRepository;
use App\Repositories\ClientPeopleRepository;

class ClientFactory
{
    public static function getRepository($type)
    {
        if($type == "people")
        {
            return new ClientPeopleRepository(new People());
        }
        elseif ($type == "company")
        {
            return new ClientCompanyRepository(new Company());
        }
        return null;


    }
}
