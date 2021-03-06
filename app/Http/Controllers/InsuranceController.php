<?php

namespace App\Http\Controllers;

use App\Insurance;
use App\Repositories\Interfaces\IInsuranceRepository;
use App\Repositories\Interfaces\IRepository;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{

    /**
     * @var IRepository
     */
    private $insuranceRepository;

    public function __construct(IInsuranceRepository $insuranceRepository)
    {
        $this->insuranceRepository = $insuranceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per_page = request('per_page');
        return $this->insuranceRepository->all($per_page ? $per_page : 10);
    }

    public function list()
    {
        return $this->insuranceRepository->allNotPaginated();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->insuranceRepository->create($request->all());
        return response()->json(['success'=> true,'message' =>'Aseguradora creada correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param Insurance $insurance
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $insurance = $this->insuranceRepository->find($id);
        return response()->json(['success'=> true,'insurance' =>$insurance]);
    }

    public function getBranches($id)
    {
        $branches = $this->insuranceRepository->branches($id);

        return response()->json(['success' => true, 'branches' => $branches]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $insuranceUpdated = $this->insuranceRepository->update($request->all(),$id);
        return response()->json(['success'=> true,'message' =>'Aseguradora actualizada correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $insuranceDeleted = $this->insuranceRepository->delete($id);
        return response()->json(['success'=> true,'message' =>'Aseguradora creada correctamente']);
    }
}
