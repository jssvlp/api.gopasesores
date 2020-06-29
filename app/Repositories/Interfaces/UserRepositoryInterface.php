<?php


namespace App\Repositories\Interfaces;


use App\User;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function activate(int $id );
    public function deactivate(int $id);
}
