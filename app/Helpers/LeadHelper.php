<?php
namespace App\Helpers;
use App\Models\Lead;

class LeadHelper{

    public static function _leadCreate($user_id)
    {
        $lead_create = Lead::create([
            'user_id'=>$user_id,
        ]);
        return "Lead created";
    }

    public static function _leadDelete($user_id)
    {
        $delete_lead = Lead::where('user_id',$user_id)->delete();
        return "Lead Created";
    }

    public static function _findLead($user_id)
    {
        $find_lead = Lead::where('user_id',$user_id)->withTrashed()->first();
        return $find_lead;
    }
}

?>