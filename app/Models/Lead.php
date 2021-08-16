<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use SoftDeletes;
    protected $table = "lead";

    public $fillable = ['user_id'];

    protected $dates = ['deleted_at'];
}
