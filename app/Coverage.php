<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coverage extends Model
{
    protected  $fillable = ['name'];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
