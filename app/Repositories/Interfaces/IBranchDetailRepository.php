<?php


namespace App\Repositories\Interfaces;


interface IBranchDetailRepository
{
    public function add($data);
    public function get($id);
    public function update($id, $data);
}
