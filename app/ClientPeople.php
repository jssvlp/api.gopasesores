<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPeople extends Model
{


    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }



    public function client()
    {
        return $this->belongsToMany(Client::class,'clients');
    }
}
