<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',  'type','document_type', 'extension', 'model','model_id','url'
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
