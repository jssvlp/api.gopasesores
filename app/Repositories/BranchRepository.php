<?php


namespace App\Repositories;


use App\Branch;
use App\Helpers\General\CollectionHelper;
use App\Repositories\Interfaces\BranchRepositoryInterface;


class BranchRepository implements BranchRepositoryInterface
{

    private $model;

    /**
     * BranchRepository constructor.
     * @param Branch $branch
     */
    public function __construct(Branch $branch)
    {
        $this->model = $branch;
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
        $model = $this->model->find($id);
        if (null == $model ) {
            return null;
        }
        return $model;
    }
}
