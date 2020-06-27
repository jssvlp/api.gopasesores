<?php


namespace App\Repositories;


use App\Client;
use App\Contact;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
    public function all()
    {
        $query = "SELECT  cp.id,'people' as type,cp.first_name as name, cp.last_name,cp.document_number,cp.birth_date,cs.cell_phone_number,cs.email,c.status FROM gopasesores.clients c INNER JOIN gopasesores.client_people cp ON (c.client_people_id = cp.id) LEFT JOIN gopasesores.contacts cs ON (cs.id = c.contact_id)
                UNION ALL
                SELECT  cc.id,'company' as type,cc.business_name as name, '' as last_name,cc.rnc as document_number,cc.constitution_date as birth_date,cs.cell_phone_number,cs.email,c.status FROM gopasesores.clients c INNER JOIN gopasesores.client_companies cc ON (c.client_people_id = cc.id) LEFT JOIN gopasesores.contacts cs ON (cs.id = c.contact_id)	";

        $clientsPeople = DB::table('clients')
            ->join('client_people', 'clients.client_people_id', '=', 'client_people.id')
            ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
            ->select(DB::raw('client_people.id, "people" as type, client_people.first_name as name,client_people.last_name,client_people.document_number,client_people.birth_date,contacts.cell_phone_number,contacts.email,clients.status'));

        $allClients = DB::table('clients')
            ->join('client_companies', 'clients.client_company_id', '=', 'client_companies.id')
            ->leftJoin('contacts', 'clients.contact_id', '=', 'contacts.id')
            ->select(DB::raw('client_companies.id, "company" as type, client_companies.business_name as name,"" as last_name,client_companies.rnc as document_number,client_companies.constitution_date as birth_date,contacts.cell_phone_number,contacts.email,clients.status'))
            ->unionAll($clientsPeople);


        return $allClients;
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
}
