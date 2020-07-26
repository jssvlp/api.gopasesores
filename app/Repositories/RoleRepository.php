<?php


namespace App\Repositories;


use App\Helpers\General\CollectionHelper;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{

    /**
     * @var Role
     */
    private $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function all($per_page)
    {
        $all =  $this->model::with('permissions')->get();
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
        $role = $this->model::with('permissions')->where('id',$id)->first();
        if (null == $role ) {
            return null;
        }
        return $role;
    }

    public function search($id)
    {
        if (null == $role = $this->model->find($id)) {
            return null;
        }
        return $role;
    }

    public function associatePermissionToRole($role,$permission)
    {
        return $role->givePermissionTo($permission);
    }

    public function revokePermissionToRole($role,$permission)
    {
        return $role->revokePermissionTo($permission);
    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }
}
