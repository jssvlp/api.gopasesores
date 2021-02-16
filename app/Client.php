<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ["owner_id","authorize_data_processing","comment","type",""];
    protected $appends = [];
    public function owner()
    {
        return $this->belongsTo('App\Employee', 'owner_id');
    }

    public function related()
    {
        return $this->belongsTo('App\Client','related_client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function people()
    {
        return $this->hasOne(People::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'client_has_categories','category_id','client_id');
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }


    public function getLastClientNameAttribute()
    {
        $clientType = $this->people_id;
        return $clientType;
        if($clientType == 'poeple')
        {
            return $this->people->firtst_name + ' ' + $this->peoplw->last_name;
        }
        return $this->company->bussiness_name;
    }
}
