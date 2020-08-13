<?php


namespace App\Repositories;


use App\Client;
use App\File;
use App\Repositories\Interfaces\FileRepositoryInterface;

class FileRepository implements FileRepositoryInterface
{
    /**
     * @var File
     */
    private $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function all()
    {
        return $this->file::all();
    }

    public function create($file)
    {
        return $this->file->create($file);
    }

    public function update($id, $data)
    {
        return $this->file->whereId($id)->update(
            $data
        );
    }

    public function delete($id)
    {
        return $this->file->destroy($id);
    }



    public function getType($document)
    {
        $document['extension'] = pathinfo($document['name'], PATHINFO_EXTENSION);
        $document['type'] = \GuzzleHttp\Psr7\mimetype_from_filename($document['name']);

        return $document;
    }


    public function allByModel($model, $model_id)
    {
        return $this->file::where('model',$model)->where('model_id',$model_id)->get();
    }
}
