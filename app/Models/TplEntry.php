<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TplEntry extends Model
{
    protected $table = "tpl_entry";

    protected $guarded = [];
    public function getTpltype(){
        return $this->hasOne('App\Models\TplType','tpl_type_id','tpl_type_id');
    }
    public function getTplSubType(){
        return $this->hasOne('App\Models\TplSubType', 'tpl_sub_type_id','tpl_sub_type_id');
    }
}
