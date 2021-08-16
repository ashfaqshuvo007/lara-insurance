<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    protected $table = "insurer";

    protected $guarded = [];
    
    public function getInsurerPolicyDetails()
    {
        return $this->hasOne('App\Models\InsurerPolicy','insurer_id','insurer_id');
    }

    public function getTermsCondition()
    {
        return $this->hasOne('App\Models\TermsCondition','insurer_id','insurer_id');
    }
}
