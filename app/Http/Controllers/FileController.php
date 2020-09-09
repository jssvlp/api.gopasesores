<?php

namespace App\Http\Controllers;

use App\Client;
use App\Repositories\Interfaces\IFileRepository;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    private $document_ext = ['doc', 'docx', 'pdf', 'odt'];
    /**
     * @var IFileRepository
     */
    private $repository;

    /**
     * Constructor
     */
    public function __construct(IFileRepository $repository)
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

    public function storePolicyFiles(Request $request)
    {

    }

    public function storeSinisterFile(Request $request)
    {

    }

    public function storeClientFiles(Request $request)
    {
        $this->validate($request, [
            'filenames' => 'required',
            'filenames.*' => 'mimes:doc,pdf,docx,zip'
        ]);


        if($request->hasfile('filenames'))
        {
            foreach($request->file('filenames') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/files/', $name);
                $data[] = $name;
            }
        }
    }

    public function delete($id)
    {
        $this->repository->delete($id);


        return response()->json(['success' => true,'message' =>'Archivo eliminado correctamente']);
    }
}
