<?php

namespace App\Http\Controllers;

use App\Factories\ClientFactory;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    /** @var ClientRepositoryInterface */
    private $clientRepository;
    private $userRepository;

    /**
     * ClientController constructor.
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
        $per_page = request('per_page');
        $clients = $this->clientRepository->all();
        return $clients->paginate(is_null($per_page) ? 10 : $per_page);
        //return response()->json(['status' =>'success',cli],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //TODO: aplicar factory patther because there are 3 types of clients
        $clientRepository = ClientFactory::getRepository($request->type);
        if($clientRepository == null)
        {
            return response()->json(['success' =>false,'error' =>'Tipo de cliente incorrecto']);
        }
        $user = $this->userRepository->create($request->user)->toArray();

        $clientData = $request->all();

        $clientData['user']['user_id'] = $user['id'];

        $client = $clientRepository->create($clientData);

        return response()->json(['success' =>true,'client' => $client],201);
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
            return response()->json(['success' =>true, 'client' =>$result],200);
        }
        return  response()->json(['success' =>false,'error' =>'Cliente no encontrado'],200);
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

        return response()->json(['success' =>true,'message' =>'Cliente modificado con éxito'],200);
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
            return response()->json(['success' =>true,'message' =>'Record deleted correctly'],200);

        }
        return response()->json(['success'=> false,'error' =>'There was an error trying to delete the record'],200);
    }
}
