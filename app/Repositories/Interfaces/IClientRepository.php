<?php


namespace App\Repositories\Interfaces;


interface IClientRepository extends IRepository
{
    public function allLike(string $column, $value,$per_page);
    public function filterBy(string $column,$value,$per_page);
}
