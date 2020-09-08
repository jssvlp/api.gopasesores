<?php


namespace App\Repositories;


use App\CarBranchPolicyDetail;
use App\Repositories\Interfaces\IBranchDetailRepository;

class BranchDetailCarsRepository implements IBranchDetailRepository
{

    /**
     * @var BranchDetailCarsRepository
     */
    private $model;

    public function __construct(CarBranchPolicyDetail $model)
    {
        $this->model = $model;
    }

    public function add($data)
    {
        $this->model::create($data);
    }

    public function get($policy_id)
    {
        return $this->model->where('policy_id',$policy_id)->first();
    }

    public function update($id, $data)
    {
        return $this->model->whereId($id)->update(
            $data
        );
    }
}
