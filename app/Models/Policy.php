<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $table = "policy";

    protected $guarded = [];

    public function property()
    {
        return $this->hasMany('App\Models\Property', 'user_id', 'policy_id');
    }

    public function insurer()
    {
        return $this->hasOne('App\Models\Insurer','insurer_id','insurer_id');
    }
}
