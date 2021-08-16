<?php

namespace App\Helpers;
use App\Models\TermsCondition;
use URL;
class TermsandCondition 
{
    
    public static function getTermsandCondition($insurer_policy_id)
    {
        $get_terms_condition = TermsCondition::where('insurer_policy_id',$insurer_policy_id)->first();
        $storage_path = '/storage/uploads/terms_condition/';
       
        $url = $storage_path.$get_terms_condition['policy_file'];
        // $terms_conditiion_show = $get_terms_condition;
        return URL::asset($url);
    }
}