<?php


namespace App\Repositories;


use App\Helpers\General\CollectionHelper;
use App\Policy;
use App\Repositories\Interfaces\PolicyRepositoryInterface;

class PolicyRepository implements PolicyRepositoryInterface
{

    /**
     * @var Policy
     */
    private $model;

    public function __construct(Policy $policy)
    {
        $this->model = $policy;
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
        //TODO: with paymen info, branch detail,
        if (null == $policy = $this->model->find($id)) {
            return null;
        }
        return $policy;
    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }
}
