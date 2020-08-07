<?php


namespace App\Repositories;


use App\Branch;
use App\BranchInsurance;
use App\Exceptions\DuplicateRegistryException;
use App\Helpers\General\CollectionHelper;
use App\Insurance;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use Illuminate\Support\Facades\DB;


class BranchRepository implements BranchRepositoryInterface
{

    private $model;

    /**
     * BranchRepository constructor.
     * @param Branch $branch
     */
    public function __construct(Branch $branch)
    {
        $this->model = $branch;
    }

    public function all($per_page)
    {
        $all =  $this->model->all();
        return CollectionHelper::paginate($all,$per_page);
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
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        $model = $this->model->find($id);

        $commission = DB::table('branch_insurance')
                        ->join('insurances','branch_insurance.insurance_id','=','insurances.id')
                        ->where('branch_insurance.branch_id','=',$id)
                        ->select(DB::raw('branch_insurance.id,insurances.name as insurance, branch_insurance.commission_percentage'))
                        ->get();

        if (null == $model ) {
            return null;
        }

        $model['commissions'] = $commission;
        return $model;
    }

    public function addInsuranceCommission($insurance, $data)
    {
        if(!$this->validateIfCommissionAlreadyExist($insurance,$data['branch_id']))
        {
            return $this->model->commissions()->sync([$insurance => $data]);
        }
        throw new DuplicateRegistryException();

    }

    public function updateInsuranceCommission($commission,$data)
    {
        $commission = BranchInsurance::whereId($commission)->update(
            $data
        );

        return $commission;
    }

    public function removeInsuranceCommission($id)
    {
        return BranchInsurance::destroy($id);
    }



    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }

    private function validateIfCommissionAlreadyExist($insurance_id,$branch_id)
    {
        $result = BranchInsurance::where('insurance_id',$insurance_id)->where('branch_id',$branch_id)->first();

        return  $result != null ? true: false;
    }
}
