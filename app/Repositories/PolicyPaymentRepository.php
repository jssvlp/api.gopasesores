<?php


namespace App\Repositories;


use App\PolicyPayment;
use App\Repositories\Interfaces\IPolicyPaymentRepository;
use Carbon\Carbon;
use Dotenv\Result\Result;
use Illuminate\Support\Facades\DB;

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
        return $this->model::select('limit_payment_date','collected_insurance','collected_insurance','value_to_paid','commissioned_mount','receipt_number','collected_in_office_date','collected_insurance_date','commissioned_date')
                                ->where('policy_id','=', $policy_id)
                                ->get();
    }

    public function getUpcomingPaymentsToBeDue(): array
    {
        $today = Carbon::now();
        $until = $today->addDay(7)->format('Y-m-d');

        $sql = "select concat(coalesce(pe.first_name, comp.business_name),' ',coalesce(pe.last_name, '') ) client_name, co.cell_phone_number, co.email,
                p.limit_payment_date, pl.policy_number, CASE WHEN p.limit_payment_date < curdate() THEN 'Vencido' WHEN p.limit_payment_date > curdate() THEN 'Próximo a vencer' END as status from gopasesores.policy_payments p
                JOIN policies pl ON (pl.id = p.policy_id)
                JOIN clients c ON (c.id = pl.client_id)
                LEFT JOIN people pe ON (pe.id = c.people_id)
                LEFT JOIN contacts co ON (co.id = c.contact_id)
                LEFT JOIN companies comp ON (comp.id = c.company_id)
                where p.limit_payment_date between curdate() and '$until'
                OR p.limit_payment_date < curdate()
                AND p.collected_in_office = 0;";

        return  DB::select($sql);
    }

    public function getPaymentsPendingToCollectFromClient()
    {
        return  PolicyPayment::with(['policy','policy.client','policy.client'])
            ->where('collected_in_office','=',0)->get();
    }

    public function getPaymentsPendingToPayToInsurances()
    {
        return  PolicyPayment::with(['policy','policy.client'])
            ->where('collected_insurance','=',0)->get();
    }
}
