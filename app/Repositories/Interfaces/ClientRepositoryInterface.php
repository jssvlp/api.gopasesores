<?php


namespace App\Repositories\Interfaces;


interface ClientRepositoryInterface extends RepositoryInterface
{
    public function allLike(string $column, $value);
}
