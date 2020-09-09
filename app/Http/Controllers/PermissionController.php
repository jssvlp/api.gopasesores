<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IPermissionRepository;
use App\Repositories\Interfaces\IRepository;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{

    /**
     * @var IRepository
     */
    private $repository;

    public function  __construct(IPermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $per_page = request('per_page');
        return  $this->repository->all($per_page ? $per_page: 10);
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
        return response()->json(['success' => true, 'message' =>'Permiso creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $permission = $this->repository->find($id);

        return response()->json(['success' => true, 'permission' =>$permission]);
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

        return response()->json(['success' =>true, 'message' =>'Permiso actualizado correctamente']);
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
        return response()->json(['success' =>true, 'message' =>'Permiso eliminado correctamente']);
    }
}
