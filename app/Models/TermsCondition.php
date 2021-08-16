<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TermsCondition extends Model
{
    use SoftDeletes;

    protected $table = "terms_and_condition";

    protected $guarded = [];

    protected $dates = ['deleted_at'];

}
