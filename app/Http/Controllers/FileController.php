<?php

namespace App\Http\Controllers;

use App\Client;
use App\Repositories\Interfaces\FileRepositoryInterface;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    private $document_ext = ['doc', 'docx', 'pdf', 'odt'];
    /**
     * @var FileRepositoryInterface
     */
    private $repository;

    /**
     * Constructor
     */
    public function __construct(FileRepositoryInterface $repository)
    {
        $this->repository = $repository;
//        $this->middleware('auth');
    }

    /**
     * @param $client_id
     */
    public function index(Client $client)
    {
        $records_per_page = request('per_page');
        return $this->repository->all($client,is_null($records_per_page) ? 10 : $records_per_page);

    }
}
