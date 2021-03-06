<?php


namespace App\Helpers\General;


use App\File;
use App\Repositories\FileRepository;
use App\Repositories\Interfaces\IFileRepository;
use Illuminate\Support\Arr;

class DocumentHandler
{

    /**
     * @var IFileRepository
     */
    private $repository;

    public function __construct(IFileRepository $fileRepository)
    {
        $this->repository = $fileRepository;
    }

    public function addDocuments($documents, $model)
    {
        $type =  class_basename($model);
        foreach ($documents as $document){
            if(Arr::exists($document,'id'))
            {
                $this->repository->update($document['id'],$document);
            }
            else
            {
                $document['model'] = $type;
                $document['model_id'] = $model->id;
                $document = $this->repository->getType($document);
                $this->repository->create($document);
            }
        }
    }
}
