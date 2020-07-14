<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected  $fillable = ['name','address','phone','mail','account','rnc'];

    public function branches()
    {
        return $this->belongsTo(Branch::class);
    }
}
