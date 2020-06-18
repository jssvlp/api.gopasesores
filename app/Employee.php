<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function referredClients(){
        return $this->hasMany(Client::class);
    }

    public function clientsContact(){
        return $this->hasMany(Client::class);
    }
}
