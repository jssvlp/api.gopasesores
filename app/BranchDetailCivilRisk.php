<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchDetailCivilRisk extends Model
{
    protected $fillable = ['civil_risk_type','commercial_activity', 'address', 'special_conditions', 'policy_id'];

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }
}
