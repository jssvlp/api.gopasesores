<?php


namespace App\Repositories;


use App\Client;
use App\Contact;
use App\Helpers\General\CollectionHelper;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientRepository implements ClientRepositoryInterface
{

    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    public function all($per_page)
    {
        $clientsPeople = DB::table('clients')
            ->join('client_people', 'clients.client_people_id', '=', 'client_people.id')
            ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
            ->select(DB::raw('client_people.id, "people" as type, client_people.first_name as name,client_people.last_name,client_people.document_number,client_people.birth_date,contacts.cell_phone_number,contacts.email,clients.status'));

        return  DB::table('clients')
            ->join('client_companies', 'clients.client_company_id', '=', 'client_companies.id')
            ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
            ->select(DB::raw('client_companies.id, "company" as type, client_companies.business_name as name,"" as last_name,client_companies.rnc as document_number,client_companies.constitution_date as birth_date,contacts.cell_phone_number,contacts.email,clients.status'))
            ->unionAll($clientsPeople)
            ->paginate(is_null($per_page) ? 10 : $per_page);
    }

    public function allLike(string $column, $value,$per_page)
    {
        try{
            $clientsPeople = DB::table('clients')
                ->join('client_people', 'clients.client_people_id', '=', 'client_people.id')
                ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
                ->where($column,'like','%'.$value.'%')
                ->select(DB::raw('client_people.id, "people" as type, client_people.first_name as name,client_people.last_name,client_people.document_number,client_people.birth_date,contacts.cell_phone_number,contacts.email,clients.status'));
            dd($clientsPeople->get());
        }
        catch(\Exception $e){
            dd($e);
        }

//        dd($clientsPeople->get());
//        return  DB::table('clients')
//            ->join('client_companies', 'clients.client_company_id', '=', 'client_companies.id')
//            ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
//            ->where($column,'like','%'.$value.'%')
//            ->select(DB::raw('client_companies.id, "company" as type, client_companies.business_name as name,"" as last_name,client_companies.rnc as document_number,client_companies.constitution_date as birth_date,contacts.cell_phone_number,contacts.email,clients.status'))
//            ->get();
    }

    public function create(array $data)
    {
        $client = new Client();
        $client->referredBy()->associate($data['referred_by_id']);
        $client->contactEmployee()->associate($data['contact_employee_id']);

        $contactRepo = new ContactRespository(new Contact());
        $contact = $contactRepo->create($data['contact_info']);
        $client->contact()->associate($contact);

        $client->date_of_admission = date('Y-m-d');
        $client->authorize_data_processing = $data['authorize_data_processing'];
        $client->save();

        return $client;
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function filterBy(string $column, $values,$per_page)
    {
        $collection = collect($this->getAllClients());
        $filter = $values[0];

        if(Str::contains($column,'_at'))
        {
            $initdate = date('Y-m-d H:i:s', strtotime($values[0]));
            $endDate = date('Y-m-d H:i:s', strtotime($values[1]));
            $filtered_collection = $collection->whereBetween('created_at', [$initdate, $endDate])->values();
        }
        else
        {
            $filtered_collection = $collection->filter(function ($item) use ($filter) {
                return $item->type == $filter;
            })->values();
        }


        return CollectionHelper::paginate($filtered_collection,is_null($per_page) ? 10 : $per_page);
    }

    private function getAllClients()
    {
        $clientsPeople = DB::table('clients')
            ->join('client_people', 'clients.client_people_id', '=', 'client_people.id')
            ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
            ->select(DB::raw('client_people.id, "people" as type, client_people.first_name as name,client_people.last_name,client_people.document_number,client_people.birth_date,contacts.cell_phone_number,contacts.email,clients.status,clients.created_at'));


        return  DB::table('clients')
            ->join('client_companies', 'clients.client_company_id', '=', 'client_companies.id')
            ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
            ->select(DB::raw('client_companies.id, "company" as type, client_companies.business_name as name,"" as last_name,client_companies.rnc as document_number,client_companies.constitution_date as birth_date,contacts.cell_phone_number,contacts.email,clients.status,clients.created_at'))
            ->unionAll($clientsPeople)->get();
    }


    private function people()
    {

    }

    private function companies()
    {

    }
    private function filterByType($clients,$type)
    {

    }
}
