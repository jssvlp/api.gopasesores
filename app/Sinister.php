<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinister extends Model
{
    protected $fillable = ['sinister_company_number','type','sinister_date','notice_date',
        'insurance_notice_date','assigned_provider','facts_description','status','policy_id'
    ];

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }
}
