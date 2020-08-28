<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',  'type','document_type', 'model','model_id','url'
    ];

    protected $hidden = ['created_at','updated_at','model','model_id','type'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
