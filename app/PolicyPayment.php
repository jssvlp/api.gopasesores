<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolicyPayment extends Model
{

    protected $fillable = [
        'payment_number',
        'value_to_paid',
        'limit_payment_date',
        'commissioned_mount',
        'payment_number',
        'payment_method',
        'collected_in_office_value',
        'collected_in_office_date',
        'collected_in_office',
        'collected_insurance',
        'collected_insurance_value',
        'collected_insurance_date',
        'receipt_number',
        'commissioned',
        'commissioned_date',
        'comment',
        'accounting_code',
        'policy_id'
    ];
}
