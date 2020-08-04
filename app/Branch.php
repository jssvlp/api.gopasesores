<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','main_branch_id'];

    public function insurances()
    {
        return $this->belongsToMany(Insurance::class,'branch_insurance','insurance_id','branch_id');
    }

    public function mainBranch()
    {
        return $this->belongsTo(MainBranch::class);
    }
}
