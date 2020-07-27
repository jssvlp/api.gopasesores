<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainBranch extends Model
{
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
