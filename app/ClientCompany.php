<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCompany extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'client_has_categories','category_id','client_company_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class,'clients');
    }
}
