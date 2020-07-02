<?php


namespace App\Repositories;


use App\Client;
use App\File;
use App\Repositories\Interfaces\FileRepositoryInterface;

class FileRepository implements FileRepositoryInterface
{
    public function __construct(File $file,Client $client)
    {
        $this->file = $file;
        $this->client = $client;
    }

    public function all(Client $client,$records_per_page)
    {
        return $this->file::where('client_id',$client->id)
            ->orderBy('id', 'desc')->paginate($records_per_page);
    }

    public function create($file)
    {
        // TODO: Implement create() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }



    public function getType($ext)
    {
        // TODO: Implement getType() method.
    }

}
