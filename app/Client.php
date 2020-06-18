<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected  $fillable = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function referredBy(){
        return $this->belongsTo(Employee::class);
    }

    public function contactEmployee(){
        return $this->belongsTo(Employee::class);
    }
}
