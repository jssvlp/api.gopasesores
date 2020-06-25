<?php


namespace App\Repositories;


use App\Client;
use App\ClientPeople;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClientPeopleRepository implements ClientRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {

        $this->model = $client;
    }


    public function all()
    {
//        $this->user->with('salutation')->all();
        return $this->model->with('user')->get();
    }

    public function create(array $data)
    {
        $people = $data['people'];

        $clientPeople = new ClientPeople();

        $clientPeople->first_name = $people['first_name'];
        $clientPeople->last_name = $people['last_name'];
        $clientPeople->document_type = $people['document_type'];
        $clientPeople->document_number = $people['document_number'];
        $clientPeople->document_expire_date = $people['document_expire_date'];
        $clientPeople->document_expedition_date = $people['document_expedition_date'];
        $clientPeople->gender = $people['gender'];
        $clientPeople->client_code = $people['client_code'];
        $clientPeople->birth_date = $people['birth_date'];
        $clientPeople->marital_status = $people['marital_status'];
        $clientPeople->monthly_income  = $people['monthly_income'];
        $clientPeople->currency = $people['currency'];
        $clientPeople->status = 'Activo';
        $clientPeople->occupation()->associate($people['occupation_id']);
        $clientPeople->user()->associate($data['user']['user_id']);
        $clientPeople->save();

        $clientRepo = new ClientRepository(new Client());
        $client = $clientRepo->create($data);

        $client->clientPeople()->associate($clientPeople);

        return $clientPeople;

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
}
