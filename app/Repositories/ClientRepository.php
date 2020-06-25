<?php


namespace App\Repositories;


use App\Client;
use App\Contact;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
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

    }

    public function create(array $data)
    {
        $client = new Client();
        $client->referredBy()->associate($data['referred_by_id']);
        $client->contactEmployee()->associate($data['contact_employee_id']);

        $contactRepo = new ContactRespository(new Contact());
        $contact = $contactRepo->create($data['people']['contact_info']);
        $client->contact()->associate($contact);

        $client->date_of_admission = date('Y-m-d');
        $client->authorize_data_processing = $data['authorize_data_processing'];
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
