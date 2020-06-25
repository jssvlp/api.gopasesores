<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'city','nationality','province_of_birth','postal_code','economic_activity','address_line1',
        'address_line2','cell_phone_number','phone_number','email'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
