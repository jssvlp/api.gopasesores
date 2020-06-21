<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPartnership extends Model
{
    public function client()
    {
        return $this->hasOne(Client::class,'clients');
    }
}
