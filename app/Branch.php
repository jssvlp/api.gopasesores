<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','commission_percentage','insurance_id','main_branch_id'];

    public function insurance()
    {
        return $this->hasOne(Insurance::class);
    }
}
