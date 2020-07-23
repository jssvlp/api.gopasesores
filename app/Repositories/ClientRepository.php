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
        $allClient = $this->getAllClients();
        $collection = collect($allClient);

        return CollectionHelper::paginate($collection,is_null($per_page) ? 10 : $per_page );
    }

    public function allLike(string $column, $value,$per_page)
    {
        //TODO:
        try{
            $clientsPeople = DB::table('clients')
                ->join('people', 'clients.people_id', '=', 'people.id')
                ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
                ->where($column,'like','%'.$value.'%')
                ->select(DB::raw('people.id, "people" as type, people.first_name as name,people.last_name,people.document_number,people.birth_date,contacts.cell_phone_number,contacts.email,clients.status'));
            dd($clientsPeople->get());
        }
        catch(\Exception $e){
            dd($e);
        }

    }

    public function create(array $data)
    {
        $client = new Client();
        $client->owner()->associate($data['owner_id']);
        $client->contactEmployee()->associate($data['contact_employee_id']);

        $contactRepo = new ContactRespository(new Contact());
        $contact = $contactRepo->create($data['contact_info']);
        $client->contact()->associate($contact);

        $client->user()->associate($data['user']['user_id']);
        $client->date_of_admission = date('Y-m-d');
        $client->authorize_data_processing = $data['authorize_data_processing'];
        $client->save();

        return $client;
    }

    public function update(array $data, $id)
    {
        return tap($this->model->where('id', $id))
            ->update($data)->first();
    }

    public function delete($id)
    {
        return  $this->model->destroy($id);
    }

    public function find($id)
    {
        $client = $this->model::with(['people','company','contact','owner','user','contactEmployee','categories'])->whereIn('id', [$id])->first();

        if (null == $client) {
            return null;
        }

        return $client;
    }

    public function filterBy(string $column, $values,$per_page)
    {
        $collection = collect($this->getAllClients());
        $filter = $values[0];
        //dd($filter);

        if(Str::contains($column,'_at'))
        {
            $initdate = date('Y-m-d H:i:s', strtotime($values[0]));
            $endDate = date('Y-m-d H:i:s', strtotime($values[1]));
            $filtered_collection = $collection->whereBetween('created_at', [$initdate, $endDate])->values();
        }
        else
        {
            $filtered_collection = $collection->filter(function ($item) use ($filter,$column) {
                $itemToArray = json_decode(json_encode($item), true);
                return $itemToArray[$column] == $filter;
            })->values();
        }


        return CollectionHelper::paginate($filtered_collection,is_null($per_page) ? 10 : $per_page);
    }

    private function getAllClients()
    {
        $clientsPeople = DB::table('clients')
            ->join('people', 'clients.people_id', '=', 'people.id')
            ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
            ->select(DB::raw('clients.id, "people" as type, people.first_name as name,people.last_name,people.document_number,people.birth_date,contacts.cell_phone_number,contacts.email,clients.status,clients.created_at'));


        return  DB::table('clients')
            ->join('companies', 'clients.company_id', '=', 'companies.id')
            ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
            ->select(DB::raw('clients.id, "company" as type, companies.business_name as name,"" as last_name,companies.rnc as document_number,companies.constitution_date as birth_date,contacts.cell_phone_number,contacts.email,clients.status,clients.created_at'))
            ->unionAll($clientsPeople)
            ->orderBy('id','DESC')
            ->get();
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
