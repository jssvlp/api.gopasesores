<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','commission_percentage','insurance_id','main_branch_id'];

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }

    public function mainBranch()
    {
        return $this->belongsTo(MainBranch::class);
    }
}
