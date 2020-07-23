<?php

namespace App\Http\Controllers;

use App\Client;
use App\Factories\ClientFactory;
use App\Repositories\ContactRespository;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    /** @var ClientRepositoryInterface */
    private $clientRepository;
    private $userRepository;
    /**
     * @var ContactRespository
     */
    private $contactRepository;

    /**
     * ClientController constructor.
     * @param ClientRepositoryInterface $clientRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository, UserRepositoryInterface $userRepository, ContactRespository $contactRespository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
        $this->contactRepository = $contactRespository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $per_page = request('per_page');

        return $clients = $this->clientRepository->all($per_page);
    }


    public function list()
    {
        $clients = $this->clientRepository->allNotPaginated();

        return response()->json(['success' => true, 'clients' =>$clients]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexLike($column,$value)
    {
        return $this->clientRepository->allLike($column,$value);
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
        $clientRepository = ClientFactory::getRepository($request->type);
        if($clientRepository == null)
        {
            return response()->json(['success' =>false,'message' =>'Tipo de cliente incorrecto']);
        }
        try {
            $user = $this->userRepository->create($request->user)->toArray();
        }
        catch (\Exception $exception)
        {
            if($exception->getCode() == 23000)
            {
                return response()->json(['success' => false,'message' =>'Correo electrónico en uso']);
            }
        }

        //TODO: validate if there is an error while creating the client, if  happenened THEN delete the created user

        $clientData = $request->all();

        $clientData['user']['user_id'] = $user['id'];
        $clientData['contact_info']['email'] = $user['email'];

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
        return  response()->json(['success' =>false,'message' =>'Cliente no encontrado'],200);
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
        $clientData = $request->all();
        unset($clientData['people']);
        unset($clientData['type']);
        unset($clientData['user']);
        unset($clientData['company']);
        unset($clientData['contact_info']);

        $client = $this->clientRepository->update($clientData,$id);
        $clientTypeRepository = ClientFactory::getRepository($request->type);

        $dataTypeData = $request->type === 'people' ? $request->people : $request->company;
        $clientTypeId = $client->people_id ? $client->people_id : $client->company_id;

        $clientTypeUpdateResult = $clientTypeRepository->update($dataTypeData,$clientTypeId);

        $contact_info = $request->contact_info;
        $contact_info['email'] = $request->user['email'];

        if($client->contact_id)
        {
            $contactUpdateResult = $this->contactRepository->update($contact_info, $client->contact_id);
        }
        else{
            $contact = $this->contactRepository->create($contact_info);
            $client->contact()->associate($contact);
            $client->save();
        }
        $userUpdateResult = $this->userRepository->update($request->user,$client->user_id);

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
    public function destroy(Client $client)
    {
        if($client == null)
        {
            return response()->json(['succcess' => false, 'message' =>'Este cliente no existe']);
        }

        if( $this->clientRepository->delete($client->id) === 1)
        {
            $clientTypeRepository = ClientFactory::getRepository(($client->people == null ? 'company' : 'people'));
            $this->contactRepository->delete($client->contact_id);
            $clientTypeRepository->delete(($client->people == null ? $client->company_id : $client->people_id));
            $this->userRepository->delete($client->user_id);

            return response()->json(['success' =>true,'message' =>'Record deleted correctly'],200);
        }
        return response()->json(['success'=> false,'message' =>'There was an error trying to delete the record'],200);
    }

    public function activate(Client $client)
    {

        $this->changeClientStatus($client,'Cliente');
        return response()->json(['status' => true,'message' =>'Estado del cliente modificado']);

    }

    private function changeClientStatus(Client $client, $status)
    {
        $result = $this->clientRepository->update(['status' =>$status],$client->id);
    }

    public function deactivate(Client $client)
    {
        $this->changeClientStatus($client,'Prospecto');
        return response()->json(['status' => true,'message' =>'Estado del cliente modificado']);
    }

    public function filterBy($column,Request $request)
    {
        $per_page = request('per_page');
        return $this->clientRepository->filterBy($column,$request->filter_values,$per_page);
    }
//TODO:
}
