<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',  'type', 'extension', 'client_id'
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
