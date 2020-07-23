<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name','last_name','position_id','type','commissioner','default_commission_percentage'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function referredClients(){
        return $this->hasMany(Client::class,'owner_id');
    }

}
