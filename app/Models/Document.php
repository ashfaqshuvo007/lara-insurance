<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    protected $table = "documents";
    use SoftDeletes;
    protected $guarded = [];

    protected $dates = ['deleted_at'];
}
