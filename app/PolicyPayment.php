<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolicyPayment extends Model
{
    protected $casts = [
        'files' => 'array'
    ];
}
