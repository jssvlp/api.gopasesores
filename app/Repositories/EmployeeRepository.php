<?php


namespace App\Repositories;


use App\Employee;
use App\Helpers\General\CollectionHelper;
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
        $employees = $this->model::with('position')->get();
        return CollectionHelper::paginate($employees,is_null($per_page) ? 10 : $per_page);
    }

    public function create(array $data)
    {
        $employee = $this->model::create($data);
        $employee->save();

        $employee->user()->associate($data['user_id']);
        return $employee->save();

    }

    public function update(array $data, $id)
    {
        return tap($this->model->where('id', $id))
            ->update($data)->first();
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        $employee = $this->model::with(['user','position','referredClients'])->whereIn('id', [$id])->first();

        if (null == $employee) {
            return null;
        }

        return $employee;
    }

    public function findByUser($id)
    {
        $employee = $this->model::where('user_id',$id)->first();

        if (null == $employee) {
            return null;
        }

        return $employee;
    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }
}
