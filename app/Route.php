<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    private $fillable = [
        'name'
    ];

    private function users()
    {
        return $this->hasMany(User::class);
    }
}
