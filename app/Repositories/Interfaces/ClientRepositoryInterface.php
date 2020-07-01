<?php


namespace App\Repositories\Interfaces;


interface ClientRepositoryInterface extends RepositoryInterface
{
    public function allLike(string $column, $value,$per_page);
    public function filterBy(string $column,$value,$per_page);
}
