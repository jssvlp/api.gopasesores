<?php


namespace App\Repositories;


use App\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClientRepository implements ClientRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Client $client)
    {
        $this->model = $client;
    }


    public function all()
    {
        $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $post = $this->model->find($id)) {
            throw new ModelNotFoundException("Post not found");
        }

        return $post;
    }
}
