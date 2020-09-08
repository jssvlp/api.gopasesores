<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarBranchPolicyDetail extends Model
{
    protected   $fillable = ['vehicle_type','brand','model','year','chassis','registry','passengers_quantity',
        'cylinders','tons','inferable','endorsement_of_assignment','plan_type','policy_id'];


    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }
}
