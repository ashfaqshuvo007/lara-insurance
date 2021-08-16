<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
    protected $table = "reporting";

    protected $guarded = [];

    public function getPolicy()
    {
        return $this->hasOne('App\Models\Policy','policy_id','policy_id');
    }
}
