<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','main_branch_id','has_detail'];

    public function commissions()
    {
        return $this->belongsToMany('App\Insurance')
                    ->using(BranchInsurance::class)
                    ->withPivot('isc_percent','multiple_beneficiaries','commission_percentage')
                    ->withTimestamps();
    }

    public function coverages()
    {
        return $this->hasMany(Coverage::class);
    }

    public function mainBranch()
    {
        return $this->belongsTo(MainBranch::class);
    }
}
