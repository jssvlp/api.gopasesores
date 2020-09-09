<?php

namespace App\Http\Controllers;

use App\File;
use App\Helpers\General\DocumentHandler;
use App\Policy;
use App\Repositories\BranchDetailRepository;
use App\Repositories\FileRepository;
use App\Repositories\Interfaces\IBranchIRepository;
use App\Repositories\Interfaces\IPolicyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PoliciesController extends Controller
{
    /**
     * @var IPolicyRepository
     */
    private $policyRepository;
    /**
     * @var IBranchIRepository
     */
    private $branchRepository;

    public function __construct(IPolicyRepository $policyRepository, IBranchIRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
        $this->policyRepository = $policyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per_page = request('per_page');
        return $this->policyRepository->all($per_page ? $per_page : 10);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $branch_detail_type = $this->branchRepository->getBranchType($request->branch_id);
        $request['branch_detail_type'] = $branch_detail_type;

        $created = $this->policyRepository->create($request->all());

        if($created->id)
        {
            $created->genereteInvoinceNumber();

            if($request->has('branch_detail'))
            {
                $detailRepository = $created->getBranchDetailRepository($branch_detail_type);
                $branch_detail = $request->branch_detail;
                $branch_detail['policy_id'] = $created->id;

                $result = $detailRepository->add($branch_detail);

            }

            if($request->has('documents')){
                $document_handler = new DocumentHandler(new FileRepository(new File()));
                $document_handler->addDocuments($request->documents,$created);
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
        $branch_detail_type = $this->branchRepository->getBranchType($policy->branch_id);
        $detailRepository = $policy->getBranchDetailRepository($branch_detail_type);

        $detail = $detailRepository->get($policy->id);

        $policy = $this->policyRepository->find($policy->id);
        $policy['branch_detail'] = $detail;

        return $policy;
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

        $policy_data = $request->except(['insurance','documents','branch_detail']);
        unset($policy_data['id']);

        $updated = $this->policyRepository->update($policy_data, $policy->id);

        if($request->has('documents')){
            $document_handler = new DocumentHandler(new FileRepository(new File()));
            $document_handler->addDocuments($request->documents,$policy);
        }


        if($request->has('branch_detail'))
        {
            $branch_detail_type = $this->branchRepository->getBranchType($policy->branch_id);
            $detailRepository = $policy->getBranchDetailRepository($branch_detail_type);
            $detail = $request->branch_detail;

            //update else create
            if(Arr::exists($detail,'id'))
            {
                $id = $detail['id'];
                unset($detail['id']);
                $detailRepository->update($id, $detail);
            }
            else{
                 $detailRepository->add($detail);
            }

        }

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
        $destroyed = $this->policyRepository->delete($policy->id);

        return response()->json(['success' => true, 'message' => 'Poliza cancelada correctamente']);
    }


}
