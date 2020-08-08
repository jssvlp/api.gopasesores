<?php


namespace App\Repositories;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all($per_page)
    {
       return $this->model->paginate(is_null($per_page) ? 10 : $per_page);
    }

    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        return  $this->model::create($data);
    }

    public function activate(int $id)
    {
        return $this->update(['status'=> 'Activo'], $id);
    }

    public function deactivate(int $id)
    {
       return  $this->update(['status'=> 'Inactivo'], $id);
    }

    public function update(array $data, $id)
    {
        if(Arr::exists($data,'password'))
        {
            if($data['password'] != '')
            {
                $data['password'] = bcrypt($data['password']);
            }
            else{
                unset($data['password']);
            }
        }
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $user = $this->model->find($id)) {
            return null;
        }

        $permissions = $this->getPermissions($user);
        $user['permissions'] = $permissions;
        $roles = $user->getRoleNames();
        unset($user['roles']);

        $user['roles'] = $roles;

        return $user;
    }

    public function findByUsernameOrEmail($usernameOrMail)
    {
        if (null == $user = $this->model->where('username',$usernameOrMail)->orWhere('email',$usernameOrMail)->first()) {
            return null;
        }
        return $user;
    }

    public function getPermissions(User $user)
    {
        return $this->format($user->getPermissionsViaRoles());
    }

    protected function format($permissions)
    {
        $collection = collect($permissions);
        $paths = $this->getPaths($permissions);
        $permissions_formatted = [];
        foreach ($paths as $path)
        {
            $permission = [ 'path' => $path,'actions' => [] ];

            $actions  = $collection->filter(function($item) use ($path){
                            return $item['path']  == $path;
                            });
            $actions = $actions->map->only('action');
            $flattened = $actions->flatten()->all();

            $permission['actions'] = $flattened;
            array_push($permissions_formatted,$permission);
        }

        return $permissions_formatted;

    }

    private function getPaths($permissions)
    {
        $uniques = $permissions->unique('path');
        $uniques = $uniques->map->only('path');
        $flattened = $uniques->flatten();

        return $flattened->all();
    }

    public function addUserToRole($user, $role)
    {
        $user = $this->model->find($user);

        $roleRepository = new RoleRepository(new Role());

        $role = $roleRepository->find($role);

        return $user->assignRole($role);
    }

    public function removeUserFromRole($user, $role)
    {
        $user = $this->model->find($user);
        //dd($user);
        $roleRepository = new RoleRepository(new Role());

        $role = $roleRepository->search($role);

        return $user->removeRole($role);
    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }
}
