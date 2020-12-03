<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\IPolicyPaymentRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    /**
     * @var IPolicyPaymentRepository
     */
    private $repository;

    public function  __construct(IPolicyPaymentRepository $policyPaymentRepository)
    {
        $this->repository  = $policyPaymentRepository;
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

    public function getPolicyPayments()
    {
        $policy = request('policy');

        return response()->json(['success' =>true, 'payments' =>$this->repository->getPolicyPayments($policy)]);
    }

    public function create(Request  $request)
    {
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
