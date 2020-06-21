<?php


namespace App\Repositories;


use App\Client;
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
        dd('Desde Repositorio Cliente Persona');
        $client = new Client();
        $client->date_of_admission = date('Y-m-d');
        $client->status = 'Activo';
        $client->referredBy()->associate($data['referred_by_id']);
        $client->contactEmployee()->associate($data['contact_employee_id']);
        $client->user()->associate($data['user_id']);

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
        if (null == $post = $this->model->find($id)) {
            return null;
        }

        return $post;
    }
}
