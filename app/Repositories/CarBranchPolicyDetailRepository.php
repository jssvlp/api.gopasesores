<?php


namespace App\Repositories;


use App\CarBranchPolicyDetail;
use App\Repositories\Interfaces\CarBranchPolicyDetailRepositoryInterface;

class CarBranchPolicyDetailRepository implements CarBranchPolicyDetailRepositoryInterface
{

    /**
     * @var CarBranchPolicyDetail
     */
    private $model;

    public function __construct(CarBranchPolicyDetail $branchPolicyDetail)
    {
        $this->model = $branchPolicyDetail;
    }

    public function all($per_page)
    {
        return $this->model::all();
    }

    public function create($file)
    {
        return $this->model->create($file);
    }

    public function update($id, $data)
    {
        return $this->model->whereId($id)->update(
            $data
        );
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }
}
