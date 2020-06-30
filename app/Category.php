<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function clients()
    {
        return $this->belongsToMany(Client::class,'client_has_categories','client_id','category_id');
    }

}
