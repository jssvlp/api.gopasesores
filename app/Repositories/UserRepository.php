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
        $user->first_name = $data['first_name'];
        $user->first_lastname = $data['first_lastname'];
        $user->second_lastname = $data['second_lastname'];
        $user->email =  $data['email'];
        $user->status = 'Activo';
        $user->password = bcrypt('123456');
        $user->save();

        return $user;
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
        // TODO: Implement find() method.
    }
}
