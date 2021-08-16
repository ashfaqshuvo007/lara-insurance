<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsurerPolicy extends Model
{
    use SoftDeletes;
    
    protected $table = "insurer_policy";

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function getPolicytype(){
        return $this->hasOne('App\Models\PolicyType','policy_type_id','policy_type_id');
    }
    public function getPolicySubType(){
        return $this->hasOne('App\Models\PolicySubType', 'policy_sub_type_id','policy_sub_type_id');
    }
}
