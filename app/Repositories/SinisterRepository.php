<?php


namespace App\Repositories;


use App\Helpers\General\CollectionHelper;
use App\Repositories\Interfaces\ISinisterRepository;
use App\Sinister;

class SinisterRepository implements ISinisterRepository
{

    /**
     * @var Model
     */
    private $model;

    public function __construct(Sinister $model)
    {
        $this->model = $model;
    }
    public function all($per_page)
    {
        $all =  $this->model::all();
        return CollectionHelper::paginate($all,$per_page);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->whereId($id)->update(
            $data
        );
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
       return $this->model->find($id);
    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }
}
