<?php

namespace App\Http\Controllers;

use App\Branch;
use App\MainBranch;
use App\Repositories\BranchBranchRepository;
use App\Repositories\Interfaces\IBranchRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * @var BranchBranchRepository
     */
    private $repository;

    public function __construct(IBranchRepository $branchRepository)
    {
        $this->repository = $branchRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
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
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());
        return response()->json(['success'=> true,'message' =>'Ramo creado correctamente']);
    }

    /**
     * @param Request $request
     * @param $insurance_id
     * @return JsonResponse
     * @throws \App\Exceptions\DuplicateRegistryException
     */
    public function addInsuranceCommission(Request $request,$insurance_id)
    {
        $this->repository->addInsuranceCommission($insurance_id,$request->except(['insurance_id']));
        return response()->json(['success'=> true,'message' =>'Comisión registrada  correctamente']);
    }

    public function getInsuranceCommission($commission_id)
    {
        $commission = $this->repository->getInsuranceCommission($commission_id);
        return response()->json(['success'=> true,'commission' => $commission]);
    }

    public function updateInsuranceCommission(Request $request, $commission_id)
    {
        $this->repository->updateInsuranceCommission($commission_id, $request->all());
        return response()->json(['success'=> true,'message' =>'Comisión actualizada  correctamente']);
    }

    public function removeInsuranceCommission($commision_id)
    {
        $this->repository->removeInsuranceCommission($commision_id);
        return response()->json(['success'=> true,'message' =>'Comisión removida  correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(Branch $branch)
    {
        $branch = $this->repository->find($branch->id);
        return response()->json(['success' => true, 'branch' => $branch]);
    }

    public function getByInsurance($id)
    {


    }



    public function main()
    {
        $branches = MainBranch::all();
        return response()->json(['success'=>true,'branches' => $branches]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $updated = $this->repository->update($request->all(),$id);

        return response()->json(['success' =>true,'message' =>'Ramo actualizado corrrectamente']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json(['success' =>true,'message' =>'Ramo borrado corrrectamente']);
    }
}
