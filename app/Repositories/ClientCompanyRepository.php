<?php


namespace App\Repositories;


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
        dd('Desde Repositorio Cliente Persona');
        // TODO: Implement create() method.
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
