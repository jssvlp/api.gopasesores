<?php


namespace App\Repositories;


use App\Contact;
use App\Repositories\Interfaces\RepositoryInterface;

class ContactRespository implements RepositoryInterface
{

    /**
     * @var Contact
     */
    private $model;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model::create($data);
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
