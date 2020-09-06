<?php


namespace App\Repositories;


use App\Client;
use App\Repositories\Interfaces\StatisticsRepositoryInterface;

class StatisticsRepository implements StatisticsRepositoryInterface
{

    public function all()
    {
        $clients = $this->clients();

        return ['clients' => $clients];
    }

    public function clients(){
        $clients = Client::all()->count();
        $clientBytype = Client::orderBy('name', 'desc')
            ->groupBy('count')
            ->having('count', '>', 100)
            ->get();
    }
}
