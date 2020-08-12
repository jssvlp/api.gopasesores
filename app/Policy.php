<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable = ['code','status','validity_start_date','validity_end_date',
        'renewable','description_insure_property','client_id','additional_beneficiary_name',
        'additional_beneficiary_document','protected_comment','public_comment','branch_id','branch_id',''];
}
