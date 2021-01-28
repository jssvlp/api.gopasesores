<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IPolicyPaymentRepository;
use App\Repositories\Interfaces\IPolicyRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    /**
     * @var IPolicyPaymentRepository
     */
    private $repository;
    private $policyRepository;

    public function  __construct(IPolicyPaymentRepository $policyPaymentRepository, IPolicyRepository $policyRepository)
    {
        $this->repository  = $policyPaymentRepository;
        $this->policyRepository = $policyRepository;
    }

    public function getPaymentsPendingToCollectFromClient()
    {
        //TODO: get all the payments where collected_client = false
    }

    public function getPaymentsPendingToPayToInsurances()
    {
        //TODO: get all the payments where collected_client = true and collected_insurance = false
    }

    public function recollectPaymentFromClient(Request $request)
    {
        //TODO: Se puede hacer un pago parcial o total. Cuando el  valor a pagar es menor
        //Este valor se adiciona al siguiente pago, si no hay pagos pendientes, se creará un pago para este saldo.
    }

    public function sendPaymentToInsurance(Request $request)
    {
        //TODO: actualiza el pago de la poliza hacia la aseguradora
    }

    public function getUpcomingPaymentsToBeDue()
    {
        //TODO: traer todos los pagos que estan proximos a vencer en los siguientes N dias (n < 10)
    }

    public function getPolicyPayments()
    {
        $policy = request('policy');
        $payments = $this->repository->getPolicyPayments($policy);
        $months = 0;

        if(count($payments) > 1)
        {
            $this_month = Carbon::parse($payments[1]['limit_payment_date'])->floorMonth(); // returns 2019-07-01
            $start_month = Carbon::parse($payments[0]['limit_payment_date'])->floorMonth(); // returns 2019-06-01
            $months = $start_month->diffInMonths($this_month);  // returns 1
        }

        return response()->json(['success' =>true, 'data' => ['dues' => count($payments),'months' => $months, 'payments' => $payments]]);
    }

    public function create(Request  $request)
    {
        
        //1. Validar si hay pagos creados
        //2. Si hay pagos creados solo se puede permitir crear un nuevo pago si el total de la poliza ya fue pagada y tiene estatus renovada
        $policy = $this->policyRepository->find($request->policy_id);
        $payments = collect($this->repository->getPolicyPayments($request->policy_id));
        
        if(count($payments) > 0)
        {
            $pendingPayments = $payments->filter(function ($payment){
                return $payment->collected_insurance == 0;
            });
            
            if(count($pendingPayments) > 0 && $policy->status == 'Vigente')
            {
                return response()->json(['success' => false, 'message' => 'Esta poliza posee pagos pendietes y no tiene estatus renovada. No es posible crear nuevos pagos ']);
            }

            if($policy->status != 'Renovada')
            {
                return response()->json(['success' => false, 'message' => 'Esta poliza no posee estatus Renovada. Antes de aplicar un nuevo pago es necesario renovarla']);
            }
           
        }
        //TODO: con la fecha de pago inicial y el numero de cuotas se puede establecer las fechas de las proximas cuotas

        $paymentValue = $request->prime / $request->dues;
        $paymentDateUpdated = new Carbon($request->payment_date);
        for( $i = 1; $i < $request->dues + 1; $i++)
        {
            if($i == 1)
            {
                $payment_date = $request->payment_date;
            }
            else
            {
                $paymentDateUpdated =   $paymentDateUpdated->addMonth($request->months);
                $payment_date = $paymentDateUpdated->toDateString();
            }
            $payment = [
                'payment_number' => $i,
                'value_to_paid' =>$paymentValue,
                'limit_payment_date' =>$payment_date,
                'commissioned_mount' => $request->commision_value,
                'comment' => $request->comment,
                'policy_id' => $request->policy_id
            ];
            //dd($payment);
            $created = $this->repository->create($payment);
        }
        return response()->json(['success' => true, 'message' => 'Pagos creados correctamente']);

    }

    public function update(Request $request, $id)
    {
        //TODO: actualiza pago siempre y cuando no se haya recaudado el pago
    }

    public function delete($payments)
    {
        foreach ($payments as $payment){
            //TODO: delete the payment with the id, except if collected_client = true
        }
    }



}
