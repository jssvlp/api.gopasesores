<?php


namespace App\Repositories\Interfaces;


interface IPolicyRepository extends IRepository
{
    public function filterByClient($client);
}
