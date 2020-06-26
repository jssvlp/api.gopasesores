<?php


namespace App\Repositories;


use App\Client;
use App\ClientCompany;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientCompanyRepository implements ClientRepositoryInterface
{
    protected  $client;

    public function __construct(ClientCompany $clientCompany)
    {
        $this->client = $clientCompany;
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function create(array $data)
    {
        $company = $data['company'];
        $clientCompany = $this->client::create($company);

        $clientRepo = new ClientRepository(new Client());
        $client = $clientRepo->create($data);

        $client->clientCompany()->associate($clientCompany);
        $client->user()->associate($data['user']['user_id']);
        $client->save();

        return $client;

    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }
}
