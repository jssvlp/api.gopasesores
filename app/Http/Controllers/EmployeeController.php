<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{

    /**
     * @var EmployeeRepositoryInterface
     */
    private $repository;

    public function __construct(EmployeeRepositoryInterface $repository, UserRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $per_page = request('per_page');
        return $this->repository->all($per_page);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $user_data = $request->user;
            $full_name = $request->first_name .' '.$request->last_name;
            $user_data['full_name'] = $full_name;
            $user_data['status'] = 'Activo';

            $user = $this->userRepository->create($user_data);
        }catch (\Exception $exception){
            if($exception->getCode() == 23000)
            {
                return response()->json(['success' => false,'message' =>'Correo electrónico en uso']);
            }
        }

        $employee_data = $request->except('user');

        $employee_data['user_id'] = $user['id'];

        $create_employee = $this->repository->create($employee_data);

        return response()->json(['success' =>true, 'message' =>'Empleado creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return JsonResponse
     */
    public function show($id)
    {
        $employee = $this->repository->find($id);
        return response()->json(['success' =>true, 'employee' =>$employee]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, Employee $employee)
    {
        $user_data = $request->only('user');
        $employee_data = $request->except('user');

        $employee_updated = $this->repository->update($employee_data,$employee->id);

        $user_updated = $this->userRepository->update($request->user,$employee->user_id);

        return response()->json(['success'=>true,'message' =>'Employee updated correctly!']);
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
        return response()->json(['success'=>true,'message' =>'Employee deleted correctly!']);

    }
}
