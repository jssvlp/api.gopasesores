<?php


namespace App\Repositories\Interfaces;


use App\Client;

interface FileRepositoryInterface
{

    public function all();
    public function allByModel($model,$model_id);
    public function create($file);
    public function update($id,$data);
    public function delete($id);
    public function getType($document);


}
