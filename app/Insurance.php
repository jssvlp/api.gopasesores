<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected  $fillable = ['name','address','phone','email','account','rnc'];

    public function branches()
    {
        return $this->belongsToMany(Branch::class,'branch_insurance','insurance_id','branch_id');
    }
}
