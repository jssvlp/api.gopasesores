<?php

namespace App\Http\Controllers;

use App\File;
use App\Helpers\General\DocumentHandler;
use App\Policy;
use App\Repositories\FileRepository;
use App\Repositories\Interfaces\PolicyRepositoryInterface;
use Illuminate\Http\Request;

class PoliciesController extends Controller
{
    /**
     * @var PolicyRepositoryInterface
     */
    private $repository;

    public function __construct(PolicyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per_page = request('per_page');
        return $this->repository->all($per_page ? $per_page : 10);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $created = $this->repository->create($request->all());

        if($created->id)
        {
            $created->genereteInvoinceNumber();

            if($request->has('branch_detail'))
            {

            }

            if($request->has('documents'))
            {
                if($request->has('documents')){
                    $document_handler = new DocumentHandler(new FileRepository(new File()));
                    $document_handler->addDocuments($request->documents,$created);
                }
            }
        }


        return response()->json(['success' =>true, 'message' =>'Poliza creada correctamente']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        return  $this->repository->find($policy->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Policy $policy)
    {
        if(!$policy->isActive())
        {
            return response()->json(['success' =>false,'message' =>'Esta póliza no puede ser actualizada porque está cancelada']);
        }
        $updated = $this->repository->update($request->all(), $policy->id);

        return response()->json(['success' => true, 'message' => 'Poliza actualizada correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Policy $policy)
    {
        $destroyed = $this->repository->delete($policy->id);

        return response()->json(['success' => true, 'message' => 'Poliza cancelada correctamente']);
    }


}
