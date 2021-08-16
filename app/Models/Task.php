<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    //
    protected $table = "task";

    use SoftDeletes;



    protected $guarded = [];

    public function user(){
        return $this->hasOne('App\User', 'id','assigned_to');

    }
    protected $dates = ['deleted_at'];
}
