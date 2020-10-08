<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ISinisterRepository;
use App\Sinister;
use Illuminate\Http\Request;

class SinisterController extends Controller
{

    /**
     * @var ISinisterRepository
     */
    private $repository;

    public function __construct(ISinisterRepository $repository)
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
        $this->repository->create($request->all());
        return response()->json(['success'=> true,'message' =>'Siniestro creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Sinister $sinister)
    {
        return response()->json(['success' => true, 'sinister' => $sinister]);
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
        $updated = $this->repository->update($request->all(),$id);
        if($updated === 0)
        {
            return response()->json(['success' =>false, 'message' => 'Siniestro no encontrado']);
        }
        return response()->json(['success' =>true,'message' =>'Siniestro actualizado corrrectamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json(['success' =>true,'message' =>'Siniestro borrado corrrectamente']);
    }
}
