<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function clientsPeople()
    {
        return $this->belongsToMany(ClientPeople::class,'client_has_categories','client_people_id','category_id');
    }

    public function clientsCompany()
    {
        return $this->belongsToMany(ClientCompany::class,'client_has_categories','client_company_id','category_id');
    }

    public function test()
    {

    }
}
