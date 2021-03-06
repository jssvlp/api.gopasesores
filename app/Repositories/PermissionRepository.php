<?php


namespace App\Repositories;


use App\Helpers\General\CollectionHelper;
use App\Repositories\Interfaces\IPermissionRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements IPermissionRepository
{
    /**
     * @var Permission
     */
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function all($per_page)
    {
        $permissions = $this->permission::all();
        return CollectionHelper::paginate($permissions,$per_page);

    }

    public function create(array $data)
    {
        return $this->permission::create($data);
    }

    public function update(array $data, $id)
    {
        return $this->permission->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->permission::destroy($id);
    }

    public function find($id)
    {
        if (null == $permission = $this->permission->find($id)) {
            return null;
        }
        return $permission;
    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }
}
