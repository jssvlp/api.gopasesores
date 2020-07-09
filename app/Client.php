<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public function referredBy()
    {
        return $this->belongsTo('App\Employee', 'referred_by_id');
        //return $this->belongsTo(Employee::class,'referred_by_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contactEmployee()
    {
        return $this->belongsTo(Employee::class,'contact_employee_id');
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
