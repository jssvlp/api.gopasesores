<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $repository;
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $per_page = request('per_page');
        $users = $this->repository->all($per_page);
        return $users;
//        return $users->paginate(is_null($per_page) ? 10 : $per_page);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate($id)
    {
        $result = $this->repository->activate($id);
        if($result == 1)
        {
            return response()->json(['success' => true, 'message' =>'Usuario activado exitosamente']);
        }
        return response()->json(['success' => false, 'message' =>'Ocurrió un error al activar el usuario']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate($id)
    {
        $result = $this->repository->deactivate($id);
        if($result == 1)
        {
            return response()->json(['success' => true, 'message' =>'Usuario desactivado exitosamente']);
        }
        return response()->json(['success' => false, 'message' =>'Ocurrió un error al desactivar el usuario']);

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
        $result = $this->repository->update($request->all(),$id);
        if($result === 1)
        {
            return response()->json(['success' => true,'message' =>'Usuario modificado correctamente']);
        }
        return response()->json(['success' => false,'message' =>'Usuario modificado correctamente']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if( $this->repository->delete($id) === 1)
        {
            return response()->json(['success' =>true,'message' =>'Record deleted correctly'],200);

        }
        return response()->json(['success'=> false,'error' =>'There was an error trying to delete the record'],200);

    }
}
