<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class ClientsController extends Controller
{

    /** @var ClientRepositoryInterface */
    private $clientRepository;
    private $userRepository;

    /**
     * ClientsController constructor.
     * @param ClientRepositoryInterface $clientRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository, UserRepositoryInterface $userRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $clients = $this->clientRepository->all();
        return response()->json(['status' =>'success','clients' => $clients],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = $this->userRepository->create($request->all());
        $user = $user->toArray();
        $data = $request->all();
        $data['user_id'] = $user['id'];

        $client = $this->clientRepository->create($data);
        return response()->json(['status' =>'success','client' => $client],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $result = $this->clientRepository->find($id);
        if($result){
            return response()->json(['status' =>'success', 'client' =>$result],200);
        }
        return  response()->json(['status' =>'failure','message' =>'Record not faund'],200);
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
        $user_data = $request->only(['first_name','first_lastname','email','birth_date','phone']);
        $client_data = $request->only(['contact_employee_id','referred_by_id','status']);

        $client = $this->clientRepository->update($client_data,$id);
        $user = $this->userRepository->update($user_data,$client->user_id);

        return response()->json(['status' =>'success','message' =>'Record update correctly'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if( $this->clientRepository->delete($id) === 1)
        {
            return response()->json(['status' =>'success','message' =>'Record deleted correctly'],200);

        }
        return response()->json(['status'=> 'failure','message' =>'There was an error trying to delete the record'],200);
    }
}
