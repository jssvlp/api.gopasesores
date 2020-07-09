<?php


namespace App\Repositories;


use App\Client;
use App\People;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;

class ClientPeopleRepository implements ClientRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Client $client
     */
    public function __construct(People $client)
    {

        $this->model = $client;
    }


    public function all($per_page)
    {
        dd('asdadsa');
//        $this->user->with('salutation')->all();
        return $this->model->with('user')->get();
    }

    public function create(array $data)
    {
        $people = $data['people'];
        $clientPeople = new People();

        $clientPeople->first_name = Arr::exists($people, 'first_name') ? $people['first_name'] : null;
        $clientPeople->last_name = Arr::exists($people, 'last_name') ? $people['last_name'] : null;
        $clientPeople->document_type = Arr::exists($people, 'document_type') ? $people['document_type'] : null;
        $clientPeople->document_number = Arr::exists($people, 'document_number') ? $people['document_number'] : null;
        $clientPeople->document_expire_date = Arr::exists($people, 'document_expire_date') ? $people['document_expire_date'] : null;
        $clientPeople->document_expedition_date =  Arr::exists($people, 'document_expedition_date') ? $people['document_expedition_date'] : null;
        $clientPeople->gender = Arr::exists($people, 'gender') ? $people['gender'] : null;
        $clientPeople->client_code = Arr::exists($people, 'client_code') ? $people['client_code'] : null;
        $clientPeople->birth_date = Arr::exists($people, 'birth_date') ? $people['birth_date'] : null;
        $clientPeople->marital_status = Arr::exists($people, 'marital_status') ? $people['marital_status'] : null;
        $clientPeople->monthly_income  = Arr::exists($people, 'monthly_income') ? $people['monthly_income'] : null;
        $clientPeople->currency = Arr::exists($people, 'currency') ? $people['currency'] : null;
        $clientPeople->occupation()->associate(Arr::exists($people, 'occupation_id') ? $people['occupation_id'] : null);

        $clientPeople->save();

        $clientRepo = new ClientRepository(new Client());
        $client = $clientRepo->create($data);

        $client->people()->associate($clientPeople);


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
        if (null == $client = $this->model->find($id)) {
            return null;
        }

        return $client;
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
