<?php


namespace App\Repositories;


use App\Branch;
use App\BranchInsurance;
use App\File;
use App\Helpers\General\CollectionHelper;
use App\Insurance;
use App\Policy;
use App\PrimeCommissionPolicyInformation;
use App\Repositories\Interfaces\IPolicyRepository;

use Illuminate\Support\Facades\DB;

class PolicyRepository implements IPolicyRepository
{

    /**
     * @var Policy
     */
    private $model;

    private $query = "select p.id,p.policy_number,p.prime,p.description_insured_property,i.name 'insurance_name',b.name 'branch',concat(IFNULL(pp.document_number,''),IFNULL(c2.rnc,''))'client_document_id',concat(IFNULL(c2.business_name,''),IFNULL(concat(pp.first_name, ' ',pp.last_name),'')) 'client_name',concat(e.first_name, ' ',e.last_name) client_owner,'Pendiente por pagar' payment_status,p.public_comment,(select CASE WHEN count(sinisters.id) > 0 THEN 1 ELSE 0 END from sinisters where p.id = sinisters.policy_id) 'has_sinister',p.validity_start_date,p.validity_end_date from policies p join branch_insurance bi on p.branch_id = bi.branch_id join insurances i on bi.insurance_id = i.id join branches b on p.branch_id = b.id join clients c on p.client_id = c.id left join people pp on c.people_id = pp.id left join  companies c2 on c.company_id = c2.id join employees e on c.owner_id = e.id where p.status != 'Cancelada'";

    public function __construct(Policy $policy)
    {
        $this->model = $policy;
    }
    public function all($per_page)
    {
        $all = DB::select($this->query);
        $collection = Collect($all);
        return CollectionHelper::paginate($collection,$per_page);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->whereId($id)->update(
            $data
        );
    }

    public function delete($id)
    {
        return $this->model->whereId($id)->update(
            ['status' => 'Cancelada']
        );
    }

    public function find($id)
    {
        //TODO: with paymen info, branch detail,
        if (null == $policy = $this->model->find($id)) {
            return null;
        }
        $filesRepository = new FileRepository(new File());
        $files = $filesRepository->allByModel($policy);



        $branch = $policy->branch_id;

        $branchInsurance = BranchInsurance::where('branch_id',$branch)->first();
        $insurance = Insurance::find($branchInsurance->insurance_id);
        $policy['insurance'] = ['id' => $insurance->id, 'name' => $insurance['name']];

        $policy['documents'] = $files;

        return $policy;
    }

    private function getBrachDetail()
    {

    }

    private function addBranchDetail($policy, $branc_detail)
    {

    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }

    public function filterByClient($client)
    {
        $query = $this->query ." and c.id =$client";
        $all = DB::select($query);
        $collection = Collect($all);
        return CollectionHelper::paginate($collection,10);
    }


}
