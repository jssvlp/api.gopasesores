<?php


namespace App\Repositories;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all()
    {
       return $this->model->all();
    }

    public function create(array $data)
    {
        $user = new User();
        $user->email =  $data['email'];
        $user->status = 'Activo';
        $user->password = bcrypt($data['password']);
        $user->save();

        return $user;
    }

    public function activate(int $id)
    {
        $this->model->update(['status'=> 'Activo'], $id);
    }

    public function deActivate(int $id)
    {
        $this->model->update(['status'=> 'Inactivo'], $id);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function find($id)
    {
        if (null == $user = $this->model->find($id)) {
            return null;
        }
        return $user;
    }

    public function findByUsername($username)
    {

        if (null == $user = $this->model->where('username',$username)->first()) {
            return null;
        }
        return $user;
    }
}
