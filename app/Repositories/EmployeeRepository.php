<?php


namespace App\Repositories;


use App\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * @var Employee
     */
    private $model;

    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function all($per_page)
    {
        return $this->model->paginate(is_null($per_page) ? 10 : $per_page);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where($id)->update(
          $data
        );
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $employee = $this->model->find($id)) {
            return null;
        }
        return $employee;
    }
}
