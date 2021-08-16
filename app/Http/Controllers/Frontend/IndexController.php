<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PolicyType;
use App\Models\PolicySubType;
use Exception;

class IndexController extends Controller
{
    public function showIndex()
    {
        $get_insurance_type = PolicyType::pluck('name','policy_type_id');

        return view('fontend.head-index.head-index',['get_insurance_type'=>$get_insurance_type]); 
    }

    public function getInsuranceProduct(Request $request)
    {
        $input = $request->all();
        try {

            $get_policy_subType = PolicySubType::where('policy_type_id',$input['insuranceName'])->pluck('name','policy_sub_type_id');

            return response()->json(['success' => true, 'get_policy_subType' => $get_policy_subType]);  
        }
        //catch exception
        catch(Exception $e) {
            return response()->json(['success' => false, 'error' =>$e->getMessage()]);
            // echo 'Message: ' .$e->getMessage();
        }
    }
}
