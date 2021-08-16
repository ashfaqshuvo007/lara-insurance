<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $table = "claims";

    protected $guarded = [];

    public function getinsurer()
    {
        return $this->hasOne('App\Models\Insurer','insurer_id','insurer_id');
    }

    public function getsubPolicy()
    {
        return $this->hasOne('App\Models\PolicySubType','policy_sub_type_id','policy_type');
    }
}
