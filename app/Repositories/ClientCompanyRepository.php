<?php


namespace App\Repositories;


use App\Client;
use App\Company;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientCompanyRepository implements ClientRepositoryInterface
{
    protected  $client;

    public function __construct(Company $clientCompany)
    {
        $this->client = $clientCompany;
    }

    public function all($per_page)
    {
        // TODO: Implement all() method.
    }

    public function create(array $data)
    {
        $company = $data['company'];
        $clientCompany = $this->client::create($company);

        $clientRepo = new ClientRepository(new Client());
        $client = $clientRepo->create($data);

        $client->company()->associate($clientCompany);
        $client->user()->associate($data['user']['user_id']);
        $client->save();

        return $client;

    }

    public function update(array $data, $id)
    {
        return tap($this->model->where('id', $id))
            ->update($data)->first();
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function allLike(string $column, $value,$per_page)
    {
        // TODO: Implement allLike() method.
    }

    public function filterBy(string $column, $value, $per_page)
    {
        // TODO: Implement filterBy() method.
    }
}
