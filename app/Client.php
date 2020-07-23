<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public function owner()
    {
        return $this->belongsTo('App\Employee', 'owner_id');
    }

    public function related()
    {
        return $this->belongsTo('App\Client','related_client_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class,'related_client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function people()
    {
        return $this->belongsTo(People::class);
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

}
