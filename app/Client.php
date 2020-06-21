<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public function referredBy()
    {
        return $this->belongsTo(Employee::class);
    }

    public function contactEmployee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function clientPeople()
    {
        return $this->belongsTo(ClientPeople::class);
    }

    public function clientCompany()
    {
        return $this->belongsTo(ClientCompany::class);
    }

    public function clientPartnership()
    {
        return $this->belongsTo(ClientPartnership::class,'client_partnership_id','client_partnership');
    }

    public function clientData()
    {
        return $this->hasOne(Contact::class);
    }
}
