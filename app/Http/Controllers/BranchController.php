<?php

namespace App\Http\Controllers;

use App\Branch;
use App\MainBranch;
use App\Repositories\BranchRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * @var BranchRepository
     */
    private $repository;

    public function __construct(BranchRepository $branchRepository)
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
     * @return JsonResponse
     */
    public function addToInsurance(Request $request)
    {
        $this->repository->addToInsurance($request->insurance_id,$request->except(['insurance_id']));
        return response()->json(['success'=> true,'message' =>'Comisión registrada  correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(Branch $branch)
    {
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
