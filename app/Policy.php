<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable = ['policy_number','status','validity_start_date','validity_end_date',
        'renewable','description_insured_property','client_id','additional_beneficiary_name',
        'additional_beneficiary_document','protected_comment','public_comment','branch_id',
        'insured_amount','currency','total','prime','isc','commission_percentage',
        'commission_percentage_client_owner','day_of_payment',''];


    public  function genereteInvoinceNumber()
    {
        $invoice_number = env('INVOICE_PREFIX','GOP') . $this->id;
        $this->invoice_number = $invoice_number;
        $this->save();
    }

    public function isActive()
    {
        return $this->status != 'Cancelada';
    }
}
