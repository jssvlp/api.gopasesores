<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'business_name','rnc','rnc_expedition_date','rnc_expire_date','constitution_date',
        'client_code','economic_activity_id'
    ];

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
