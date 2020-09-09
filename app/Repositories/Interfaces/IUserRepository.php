<?php


namespace App\Repositories\Interfaces;


use App\User;

interface IUserRepository extends IRepository
{
    public function activate(int $id );
    public function deactivate(int $id);
}
