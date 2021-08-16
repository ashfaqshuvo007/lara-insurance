<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use SoftDeletes;

    protected $table = "offers";

    protected $guarded = [];

    protected $dates = ['deleted_at'];
}
