<?php


namespace App\Repositories\Interfaces;


use App\Client;

interface FileRepositoryInterface
{

    public function all(Client $client,$per_page);
    public function create($file);
    public function update($id,$data);
    public function delete($id);  
    public function getType($ext);


}
