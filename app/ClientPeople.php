<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPeople extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'client_has_categories','category_id','client_people_id');
    }

    public function client()
    {
        return $this->belongsToMany(Client::class,'clients');
    }
}
