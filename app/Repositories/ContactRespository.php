<?php


namespace App\Repositories;


use App\Contact;
use App\Repositories\Interfaces\IRepository;

class ContactRespository implements IRepository
{

    /**
     * @var Contact
     */
    private $model;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    public function all($per_page)
    {
        return $this->model->paginate(is_null($per_page) ? 10 : $per_page);
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return  $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $contact = $this->model->find($id)) {
            return null;
        }
        return $contact;
    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }
}
