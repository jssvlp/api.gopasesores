<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\PermissionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * @var RepositoryInterface
     */
    private $repository;

    public function __construct(RepositoryInterface $repository)
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());
        return response()->json(['success' => true, 'message' =>'Rol creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(Role $role)
    {
        $role = $this->repository->find($role->id);
        return response()->json(['success' => true, 'rol' =>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $updated = $this->repository->update($request->all(),$id);

        return response()->json(['success' =>true, 'message' =>'Rol actualizado correctamente']);
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
        return response()->json(['success' =>true, 'message' =>'Rol eliminado correctamente']);
    }

    public function givePermissionToRole($role,$permission)
    {
        $permission = $this->getPermission($permission);

        if($permission == null)
        {
            return response()->json(['success' =>false,'message' =>'Permiso no existe']);
        }
        $role = $this->repository->search($role);
        if($role == null)
        {
            return response()->json(['success' =>false,'message' =>'Rol no existe']);
        }
        $this->repository->associatePermissionToRole($role,$permission);

        return response()->json(['success' =>true,'message' =>'Permiso configurado correctamente']);
    }

    public function revokePermissionToRole($role,$permission)
    {
        $permission = $this->getPermission($permission);

        if($permission == null)
        {
            return response()->json(['success' =>false,'message' =>'Permiso no existe']);
        }
        $role = $this->repository->search($role);
        if($role == null)
        {
            return response()->json(['success' =>false,'message' =>'Rol no existe']);
        }
        $this->repository->revokePermissionToRole($role,$permission);

        return response()->json(['success' =>true,'message' =>'Permiso revocado correctamente']);
    }

    private function getPermission($permission)
    {
        $permissionRepository = new PermissionRepository(new Permission());
        $permission = $permissionRepository->find($permission);

        return $permission;
    }



}
