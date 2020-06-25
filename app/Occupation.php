<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    public function clientsPeople()
    {
        return $this->hasMany(ClientPeople::class);
    }
}
