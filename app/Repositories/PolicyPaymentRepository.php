<?php


namespace App\Repositories;


use App\PolicyPayment;
use App\Repositories\Interfaces\IPolicyPaymentRepository;

class PolicyPaymentRepository implements IPolicyPaymentRepository
{

    /**
     * @var PolicyPayment
     */
    private $model;

    public function __construct(PolicyPayment $policyPayment)
    {
        $this->model = $policyPayment;
    }
    public function all($per_page)
    {
        // TODO: Implement all() method.
    }

    public function create(array $data)
    {
        return $this->model->create($data);
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

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }

    public function getPolicyPayments($policy_id)
    {
        return $this->model::select('limit_payment_date','value_to_paid','commissioned_mount','receipt_number','collected_in_office_date','collected_insurance_date','commissioned_date')
                                ->where('policy_id','=', $policy_id)
                                ->where('collected_in_office','',false)->get();

    }
}
