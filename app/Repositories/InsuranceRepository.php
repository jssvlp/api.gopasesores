<?php


namespace App\Repositories;


use App\Helpers\General\CollectionHelper;
use App\Insurance;
use App\Repositories\Interfaces\IInsuranceRepository;


class InsuranceRepository implements  IInsuranceRepository
{

    /**
     * @var Role
     */
    private $model;

    public function __construct(Insurance $insurance)
    {
        $this->model = $insurance;
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
        $model = $this->model::with('branches')->where('id',$id)->first();

        if (null == $model ) {
            return null;
        }
        return $model;
    }

    public function branches($insurance_id)
    {
        $insurance = $this->model::find($insurance_id);
        return  $insurance->branches;

    }

    public function allNotPaginated()
    {
        return  $this->model::all();
    }
}
