<?php


namespace App\Repositories;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Arr;

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
        $user = new User();
        $user->email =  $data['email'];
        $user->status = 'Activo';
        $user->picture = 'https://n8d.at/wp-content/plugins/aioseop-pro-2.4.11.1/images/default-user-image.png';
        $user->password = bcrypt($data['password']);
        $user->save();

        return $user;
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
}
